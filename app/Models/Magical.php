<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magical extends Model
{
    protected $table = 'magicals';

    protected $fillable = [
        'name',
        'description',
        'power_level',
    ];
}
