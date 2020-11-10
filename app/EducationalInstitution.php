<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalInstitution extends Model
{
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

    public function researchTeamAdmins() {
        return $this->hasMany('App\ResearchTeamAdmin');
    }

    public function node() {
        return $this->belongsTo('App\Node');
    }

    public function administrator() {
        return $this->belongsTo('App\EducationalInstitutionAdmin');
    }

    public function researchGroups() {
        return $this->hasMany('App\ResearchGroup');
    }

    public function educationalEnvironments() {
        return $this->hasMany('App\EducationalEnvironment');
    }

    public function academicPrograms() {
        return $this->hasMany('App\AcademicProgram');
    }

    public function educationalInstitutionEvents() {
        return $this->hasMany('App\EducationalInstitutionEvent');
    }
}
