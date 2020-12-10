<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualNodeEvent extends Model
{
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
        'project_article'
    ];

    public function nodeEvent() {
        return $this->belongsTo('App\Models\NodeEvent', 'id');
    }
}
