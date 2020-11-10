<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalToolLoan extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'educational_tool_id',
    ];

    public function loan() {
        return $this->belongsTo('App\Loan', 'id');
    }

    public function educationalTool() {
        return $this->belongsTo('App\EducationalTool');
    }
}
