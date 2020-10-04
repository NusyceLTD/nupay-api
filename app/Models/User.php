<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasPermissionsTrait; //Import The Trait

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'is_merchant', 'address',  'is_company', 'email', 'tel_1', 'tel_1_verified', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function deposites()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function sends()
    {
        return $this->hasMany(Send::class);
    }

    public function receives()
    {
        return $this->hasMany(Receive::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function merchants()
    {
        return $this->hasMany(Merchant::class);
    }


}
