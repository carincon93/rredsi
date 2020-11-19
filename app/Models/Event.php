<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'description',
        'start_date',
        'end_date',
        'link',
    ];

    public function projects() {
        return $this->belongsToMany('App\Project', 'event_project', 'event_id', 'project_id');
    }

    public function educationalInstitutionEvent() {
        return $this->hasOne('App\EducationalInstitutionEvent', 'id');
    }

    public function nodeEvent() {
        return $this->hasOne('App\NodeEvent', 'id');
    }
}
