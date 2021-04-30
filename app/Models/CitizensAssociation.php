<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizensAssociation extends Model
{
    use HasFactory;

    protected $table = 'citizens_association';

    protected $fillable = ['name'];
}
