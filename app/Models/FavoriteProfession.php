<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteProfession extends Model
{
    use HasFactory;

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function getDateAttribute()
    {
        return date('M-d-Y ', strtotime($this->attributes['created_at']));
    }
}
