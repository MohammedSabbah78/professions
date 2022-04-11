<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(Profession::class, SubCategory::class, 'category_id', 'sub_category_id');
    }


    public function getActiveStatusAttribute()
    {
        return $this->status == 1 ? 'Active' : 'InActive';
    }

    public function professions()
    {
        return $this->hasManyThrough(Profession::class, SubCategory::class, 'category_id', 'sub_category_id');
    }
    public function getDateAttribute()
    {
        return date('M-d-Y ', strtotime($this->attributes['created_at']));
    }
}
