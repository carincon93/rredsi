<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGraduation extends Model
{
    protected $table = 'graduations';

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
        return $this->belongsTo('App\Models\User');
    }

    public function academicProgram() {
        return $this->belongsTo('App\Models\AcademicProgram');
    }

    public function userAcademicWork() {
        return $this->hasOne('App\Models\UserAcademicWork', 'graduation_id');
    }
}
