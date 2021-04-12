<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey ='product_id';

    protected $fillable = [
        'product_name',
        'product_desc',
        'product_price',
        'product_category',
    ];

    public function language()
    {
        return $this->belongsToMany(Language::class,'language_product',  'product_product_id', 'language_id',);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
