<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicWork extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'authors',
        'grade',
        'mentors',
        'research_group_id',
        'knowledge_area_id',
        'graduation_id',
    ];

    public function researchGroup() {
        return $this->belongsTo('App\Models\ResearchGroup');
    }

    public function knowledgeArea() {
        return $this->belongsTo('App\Models\KnowledgeArea');
    }

    public function graduation() {
        return $this->belongsTo('App\Models\Graduation');
    }
}
