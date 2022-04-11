<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    public function getEmailVerifiedAttribute()
    {

        return $this->email_verified_at == null ? 'Not Verify' : 'Verifed';
    }
    public function getDateAttribute()
    {
        return date('M-d-Y ', strtotime($this->attributes['created_at']));
    }
}
