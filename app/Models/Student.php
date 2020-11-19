<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cvlac',
        'is_accepted',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function isResearchTeamLeader() {
        return $this->hasOne('App\ResearchTeam', 'student_leader_id');
    }
}
