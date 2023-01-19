<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'store_id', 'description', 'image',
        'status', 'slug', 'category_id', 'price', 'compare_price'
    ];

    public static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder)
         {
            $user = Auth::user();
            if ($user && $user->store_id) {
                return $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    // relation w category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->withDefault([
                'name' => '-'
            ]);
    }
    // relation w store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')
            ->withDefault([
                'name' => '-'
            ]);
    }

    // relation w tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeActive(Builder $builder)
    {
         $builder->where('status', 'active');
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        if(!$this->image){
        return 'http://www.sitech.co.id/assets/img/products/default.jpg';
        }

        if(Str::startsWith($this->image, ['http:', 'https:'])){
            return $this->image;
        }
        return asset('storage/'.$this->image); 
    }

    public function getSalePercentAttribute()
    {
        if ($this->compare_price){
            return round(100 - (100 * $this->price / $this->compare_price) , 0);
        }
        return 0 ;
    }
}
