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
}
