<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false; //because we deleted this column in migration table

    protected $fillable = [
        'name', 'slug'
    ];

    // relation w Product
    public function tags()
    {
        return $this->belongsToMany(Product::class);
    }
}
