<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalEnvironment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'capacity_aprox',
        'description',
        'is_enabled',
        'is_available',
        'educational_institution_faculty_id',
    ];

    public function educationalTools() {
        return $this->hasMany('App\Models\EducationalTool');
    }

    public function educationalInstitutionFaculty() {
        return $this->belongsTo('App\Models\EducationalInstitutionFaculty');
    }

    public function knowledgeSubareaDisciplines() {
        return $this->belongsToMany('App\Models\KnowledgeSubareaDiscipline', 'educational_environment_knowledge_subarea_discipline', 'educational_environment_id', 'knowledge_subarea_discipline_id');
    }

    public function scopeSearchEducationalEnvironments($query, $keyword) {
        $keyword = mb_strtolower($keyword);

        return $query->select('educational_environments.*')
            ->join('educational_environment_knowledge_subarea_discipline', 'educational_environments.id', 'educational_environment_knowledge_subarea_discipline.educational_environment_id')
            ->join('knowledge_subarea_disciplines', 'educational_environment_knowledge_subarea_discipline.knowledge_subarea_discipline_id', 'knowledge_subarea_disciplines.id')
            ->join('knowledge_subareas', 'knowledge_subarea_disciplines.knowledge_subarea_id', 'knowledge_subareas.id')
            ->join('knowledge_areas', 'knowledge_subareas.knowledge_area_id', 'knowledge_areas.id')
            ->whereRaw('lower(educational_environments.name) LIKE (?)', "%$keyword%")
            ->orWhereRaw('lower(educational_environments.type) LIKE (?)', "%$keyword%")
            ->orWhereRaw('lower(knowledge_areas.name) LIKE (?)', "%$keyword%")
            ->orWhereRaw('lower(knowledge_subarea_disciplines.name) LIKE (?)', "%$keyword%");
    }
}
