<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'interests',
        'biography',
        'cvlac',
        'is_enabled',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url'
    ];

    public function isNodeAdmin() {
        return $this->hasOne('App\Models\Node', 'administrator_id');
    }

    public function isEducationalInstitutionAdmin() {
        return $this->hasOne('App\Models\EducationalInstitution', 'administrator_id');
    }

    public function isStudentLeader() {
        return $this->hasOne('App\Models\ResearchTeam', 'student_leader_id');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business','nit_business', 'nit');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business','nit_business', 'nit');
    }
    
    public function userGraduations() {
        return $this->hasMany('App\Models\UserGraduation');
    }

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'authors', 'user_id', 'project_id');
    }

    public function researchTeams() {
        return $this->belongsToMany('App\Models\ResearchTeam', 'research_team_members', 'user_id', 'research_team_id')
            ->withPivot([
                'comment',
                'accepted_at',
                'retired_at',
                'is_external',
                'authorization_letter',
            ]);
    }

    public function educationalInstitutionFaculties() {
        return $this->belongsToMany('App\Models\EducationalInstitutionFaculty', 'educational_institution_faculty_members', 'user_id', 'educational_institution_faculty_id')
            ->withPivot([
                'is_principal'
            ]);
    }
}
