<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_graduated',
        'year',
        'academic_program_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function academicProgram() {
        return $this->belongsTo('App\AcademicProgram');
    }

    public function academicWork() {
        return $this->hasOne('App\AcademicWork');
    }
}
