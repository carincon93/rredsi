<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalInstitutionAdmin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'node_id',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function node() {
        return $this->belongsTo('App\Node');
    }

    public function educationalInstitution() {
        return $this->hasOne('App\EducationalInstitution', 'administrator_id');
    }
}
