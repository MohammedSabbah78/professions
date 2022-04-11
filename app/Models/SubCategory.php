<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function professions()
    {
        return $this->hasMany(Profession::class, 'sub_category_id', 'id');
    }
    public function getActiveStatusAttribute()
    {
        return $this->status == 1 ? 'Active' : 'InActive';
    }
    public function getDateAttribute()
    {
        return date('M-d-Y ', strtotime($this->attributes['created_at']));
    }
}
