<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCitizenAssociation extends Model
{
    use HasFactory;

    protected $table = 'users_citizen_assoiciation';

    protected $fillable = [
        'user_id',
        'citizen_association_id'
    ];
}
