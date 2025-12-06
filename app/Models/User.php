<?php

namespace App\Models;

use App\Traits\ChangeLoggingTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait, ChangeLoggingTrait;

    protected $table = "users";

    protected $primaryKey = "id";

    protected $fillable = [
        'username',
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id'; // The name of the primary key in your database table
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
