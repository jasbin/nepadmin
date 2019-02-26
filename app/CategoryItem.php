<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    protected $fillable=['category_id', 'cover_image'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
