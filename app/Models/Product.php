<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        "name",
        "description",
        "price",
        "code",
        "brand",
        "availability",
        "category_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    // }
}
