<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function favoriteProfessions()
    {
        return $this->hasMany(FavoriteProfession::class, 'profession_id', 'id');
    }

    public function getGenderTypeAttribute()
    {

        return $this->gender == 'M' ? 'Male' : 'Female';
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
