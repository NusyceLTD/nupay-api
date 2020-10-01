<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name','first_name', 'merchant',  'company',  'email', 'password',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
