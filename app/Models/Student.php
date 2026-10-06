<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    public $table = 'students';


    public function myCourse(): HasOne
    {
        return $this->hasOne(
            related: Course::class,
            foreignKey: 'id',
            localKey: 'course_id'
        );
    }
}
