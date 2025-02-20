<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Password extends Model
{
    use HasFactory;

    protected $table = 'passwords';

    protected $fillable = [
        'user_id',
        'name',
        'username',
        'email',
        'URL',
        'password_encrypted',
    ];

    public function setPasswordEncryptedAttribute($value)
    {
        $this->attributes['password_encrypted'] = Crypt::encryptString($value);
    }

    public function getPasswordEncryptedAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
