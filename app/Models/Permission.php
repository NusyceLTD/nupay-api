<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public $fillable = ['name', 'level', 'slug','parentId', 'active'];

    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');

    }

    public function users() {

        return $this->belongsToMany(User::class,'users_permissions');

    }


/*
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name, '-');
        });
    }*/
}
