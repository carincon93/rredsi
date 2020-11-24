<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state', 
        'administrator_id',
    ];

    public function educationalInstitutions() {
        return $this->hasMany('App\Models\EducationalInstitution');
    }
}
