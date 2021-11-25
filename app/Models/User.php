<?php

namespace App\Models;

use App\Enum\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comments::class);
    }

    public function Admin()
    {
        return $this->roles()->where('name', Roles::Admin);
    }

    public function isAdmin()
    {
        return $this->Admin()->exists();
    }

    public static function getAdmin()
    {
        return self::whereHas(
            'roles', function ($q) {
                $q->where('name', Roles::Admin);
        }
        )->get();
    }
}
