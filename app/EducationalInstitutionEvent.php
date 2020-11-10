<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalInstitutionEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'educational_institution_id',
    ];

    public function isEvent() {
        return $this->belongsTo('App\Event', 'id');
    }

    public function educationalInstitution() {
        return $this->belongsTo('App\EducationalInstitution');
    }
}
