<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'name', 'parent_id', 'description', 'image', 'status', 'slug'
    ];

    public static function rules($id =0){
        return [
            'name' => ['required','string' , 'min:3' , 'max:255', "unique:categories,name, $id"],
            'parent_id' => ['nullable' , 'int' , 'exists:categories,id'],
            'image' => ['image'],
            'status' => ['in:active,archived'],
        ];
    }

    public function scopeFilter(Builder $builder, $filters){
        if($filters['name'] ?? false){  
            $builder->where('categories.name' , 'LIKE' ,"%{$filters['name']}%");
        }
        if($filters['status'] ?? false){  
            $builder->where('categories.status' , '=' , $filters['status']);
        }    
    }

    // relation w products
    public function products()
    {
       return $this->hasMany(Product::class ,'category_id' , 'id');
    }

        // relation w self to print parent name
    public function parent()
    {
        return $this->belongsTo(Category::class ,'parent_id' , 'id')
        ->withDefault([
            'name'=>'-'
        ]);
     }
    public function child()
    {
        return $this->hasMany(Category::class ,'parent_id' , 'id');
     }

}
