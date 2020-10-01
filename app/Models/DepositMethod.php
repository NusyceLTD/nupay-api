<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositMethod extends Model
{

    public function deposites()
    {
        return $this->hasMany(Deposit::class);
    }
}
