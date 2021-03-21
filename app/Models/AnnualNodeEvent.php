<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualNodeEvent extends Model
{
    protected $table = 'project_annual_node_event';

    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'presentation_type',
        'project_status',
        'endorsement_letter',
        'project_article',
        'status',
        'comments',
        'node_event_id',
    ];

    public function nodeEvent() {
        return $this->belongsTo('App\Models\NodeEvent', 'node_event_id');
    }
}
