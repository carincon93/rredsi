<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchTeamAdmin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'educational_institution_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function educationalInstitution() {
        return $this->belongsTo('App\EducationalInstitution');
    }

    public function isResearchTeamAdmin() {
        return $this->hasOne('App\ResearchTeam', 'administrator_id');
    }
}
