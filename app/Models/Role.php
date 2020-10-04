<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{

    public $fillable = ['name', 'isCoreRole', 'active'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }


    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name, '-');
        });
    }

}
