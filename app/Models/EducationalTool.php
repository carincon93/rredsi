<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalTool extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'qty',
        'educational_environment_id',
    ];

    public function educationalEnvironment() {
        return $this->belongsTo('App\Models\EducationalEnvironment');
    }

    public function knowledgeSubareaDisciplines() {
        return $this->belongsToMany('App\Models\KnowledgeSubareaDiscipline', 'educational_tool_knowledge_subarea_discipline', 'educational_tool_id', 'knowledge_subarea_discipline_id');
    }

    public function scopeSearchEducationalTools($query, $keyword) {
        $keyword = mb_strtolower($keyword);

        return $query->select('educational_tools.*')
            ->join('educational_tool_knowledge_subarea_discipline', 'educational_tools.id', 'educational_tool_knowledge_subarea_discipline.educational_tool_id')
            ->join('knowledge_subarea_disciplines', 'educational_tool_knowledge_subarea_discipline.knowledge_subarea_discipline_id', 'knowledge_subarea_disciplines.id')
            ->join('knowledge_subareas', 'knowledge_subarea_disciplines.knowledge_subarea_id', 'knowledge_subareas.id')
            ->join('knowledge_areas', 'knowledge_subareas.knowledge_area_id', 'knowledge_areas.id')
            ->whereRaw('lower(educational_tools.name) LIKE (?)', "%$keyword%")
            ->orWhereRaw('lower(knowledge_areas.name) LIKE (?)', "%$keyword%")
            ->orWhereRaw('lower(knowledge_subarea_disciplines.name) LIKE (?)', "%$keyword%");
    }
}
