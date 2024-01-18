<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Model implements Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "m_users";
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'users_name',
        'users_email',
        'users_password',
        'users_token',
        'location',
        'balance'
    ];


    public function getAuthIdentifierName()
    {
        return 'users_email';
    }

    public function getAuthIdentifier()
    {
        return $this->users_email;
    }

    public function getAuthPassword()
    {
        return $this->users_password;
    }

    public function getRememberToken()
    {
        return $this->users_token;
    }

    public function setRememberToken($value)
    {
        return $this->value;
    }

    public function getRememberTokenName()
    {
        return 'token';
    }

}
