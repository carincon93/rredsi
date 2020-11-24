<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchOutput extends Model
{
    use HasFactory;
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
        return $this->belongsTo('App\Models\Project');
    }
}
