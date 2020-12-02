<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArea extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function researchLine() {
        return $this->hasOne('App\Models\ResearchLine');
    }

    public function academicWork() {
        return $this->hasMany('App\Models\AcademicWork');
    }

    public function knowledgeSubareas() {
        return $this->hasMany('App\Models\KnowledgeSubarea');
    }
}
