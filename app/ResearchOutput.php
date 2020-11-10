<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchOutput extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'typology',
        'description',
        'file',
        'project_id',
    ];

    public function project() {
        return $this->belongsTo('App\Project');
    }
}
