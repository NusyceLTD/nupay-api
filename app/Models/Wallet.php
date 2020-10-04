<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    protected $fillable = ['currency'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
