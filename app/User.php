<?php

namespace App;

use App\Framework\Core\Model;


class User extends Model
{
    protected $fillable = [
        "name",
        "username",
        "email",
        "password"
    ];


}