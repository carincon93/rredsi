<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInstitution extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nit',
        'address',
        'city',
        'phone_number',
        'website',
        'administrator_id',
        'node_id',
    ];

    public function node() {
        return $this->belongsTo('App\Models\Node');
    }

    public function researchGroups() {
        return $this->hasMany('App\Models\ResearchGroup');
    }

    public function educationalEnvironments() {
        return $this->hasMany('App\Models\EducationalEnvironment');
    }

    public function academicPrograms() {
        return $this->hasMany('App\Models\AcademicProgram');
    }

    public function educationalInstitutionEvents() {
        return $this->hasMany('App\Models\EducationalInstitutionEvent');
    }

    public function members() {
        return $this->belongsToMany('App\Models\User', 'educational_institution_members', 'educational_institution_id', 'user_id');
    }
}
