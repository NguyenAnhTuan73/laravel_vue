<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'designation',
        'contact_no',
    ];
    use HasFactory;
}
