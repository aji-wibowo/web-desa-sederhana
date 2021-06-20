<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizensAssociation extends Model
{
    use HasFactory;

    protected $table = 'citizens_association';

    protected $fillable = ['name'];

    public function userCitizensAssociation()
    {
        return $this->hasMany('\App\Models\UserCitizenAssociation', 'citizen_association_id');
    }
}
