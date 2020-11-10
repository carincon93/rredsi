<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state', 
        'administrator_id',
    ];

    public function educationalInstitutions() {
        return $this->hasMany('App\EducationalInstitution');
    }

    public function administrator() {
        return $this->belongsTo('App\NodeAdmin');
    }

    public function educationalInstitutionAdmins() {
        return $this->hasMany('App\EducationalInstitutionAdmin');
    }
}
