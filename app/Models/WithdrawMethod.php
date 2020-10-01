<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{

    public function withdraw()
    {
        return $this->hasMany(Deposit::class);
    }
}
