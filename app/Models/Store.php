<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

     //protected $table = 'محلات'; ---> different table
     //protected $connection = 'mysql-2'; ---> different DB
     //protected $pimaryKey = 'number'; ---> different pk default "id"
        //public $increminting = true; --->default pk is autoincrement
    //public $timestamps = false;---> عند حذف timestamps

     // relation w products
     public function products(){
        return $this->hasMany(Product::class ,'store_id' , 'id');
     }
 
}




