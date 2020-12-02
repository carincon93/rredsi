<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = ['datesForHumans'];

    public function projects() {
        return $this->belongsToMany('App\Models\Project', 'event_project', 'event_id', 'project_id');
    }

    public function educationalInstitutionEvent() {
        return $this->hasOne('App\Models\EducationalInstitutionEvent', 'id');
    }

    public function nodeEvent() {
        return $this->hasOne('App\Models\NodeEvent', 'id');
    }

    public function getDatesForHumansAttribute() 
    {
        $start_date = Carbon::parse($this->start_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        $end_date   = Carbon::parse($this->end_date, 'UTC')->locale('es')->isoFormat('DD [de] MMMM [de] YYYY');
        return "Del $start_date al $end_date";
    }
}
