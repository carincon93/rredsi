<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document_type',
        'document_number',
        'cellphone_number',
        'status',
        'interests',
        'is_enabled',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function isResearcher() {
        return $this->hasOne('App\Researcher', 'id');
    }

    public function isStudent() {
        return $this->hasOne('App\Student', 'id');
    }

    public function isNodeAdmin() {
        return $this->hasOne('App\NodeAdmin', 'id');
    }

    public function isEducationalInstitutionAdmin() {
        return $this->hasOne('App\EducationalInstitutionAdmin', 'id');
    }

    public function isResearchTeamAdmin() {
        return $this->hasOne('App\ResearchTeamAdmin', 'id');
    }

    public function graduations() {
        return $this->hasMany('App\Graduation');
    }

    public function projects() {
        return $this->belongsToMany('App\Project', 'authors', 'user_id', 'project_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\ResearchTeam', 'research_team_members', 'user_id', 'research_team_id')
            ->withPivot([
                'comment',
                'accepted_at',
                'retired_at',
                'is_external',
                'authorization_letter',
            ]);
    }
}
