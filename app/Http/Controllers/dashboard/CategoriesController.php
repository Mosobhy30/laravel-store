<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
  
    public function index()
    {   
        //filter
        $request = request();    //get user request object
        // $query = Category::query();   //get query builder object

        //assign value to name and check if exist
           // $name = $request->query('name')
           //if ($name)
        /* if($name = $request->query('name')){  
            $query->where('name' , 'LIKE' ,"%{$name}%");
        }
        
        if($status = $request->query('status')){
            $query->where('status' , '=' ,"$status");
        } */

        // dd($query);
       // $categories = $query->paginate();

       
        // Select a.* , b.name as parent_name 
        // from categories as a 
        // leftjoin categories as parent on
        // a.id = parent.parent_id

        $categories = Category::with('parent')
       //leftjoin('categories as parent', 'parent.id','=','categories.parent_id')
       // ->select([
            //'categories.*',
          //  'parent.name as parent_name'
       // ])
        ->withcount('products')
        ->filter($request->query())
        ->orderby('id')
        ->paginate(12);
        return view('dashboard.categories.index', compact('categories'));
    }

    
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

   
    public function store(Request $request)
    {
        $request->validate(Category::rules());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadPImage($request);
        $category = Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created!');
    }

    
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

   
    public function edit($id)
    {
        try {

            $category = Category::findOrfail($id);
        } catch (Exception $e) {
            return redirect()->route('categories.index')
                ->with('info', 'Not Found !!');
        }
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orwhere('parent_id', '<>', $id);
            })
            ->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate(Category::rules($id));
        $category = Category::findOrfail($id);

        $old_image = $category->image;
        $data = $request->except('image');
        $path = $this->uploadPImage($request);

        if ($path) {
            $data['image'] = $path;
        }

        $category->update($data);
        if ($request->image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('categories.index')
            ->with('success', 'Category updated !!');
    }

   

    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
       
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted !!');
    }

    protected function uploadPImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        return $path;
    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate(); 
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request , $id){
        $category = Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('categories.trash')
            ->with('success' , 'Restored !!') ;
    }

    public function forceDelete($id){
        
        $category = Category::onlyTrashed()->findOrFail($id);
        if ( $category->image  ) {
            Storage::disk('public')->delete($category->image);
        //dd( $category->image );
        $category ->forceDelete();
       
        }
        return redirect()->route('categories.trash')
            ->with('success' , 'Dleted forever !!') ;
    }
}
