<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAcademicWork extends Model
{
    protected $table = 'academic_works';

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
        'research_group_name',
        'knowledge_area_id',
        'graduation_id',
    ];

    public function knowledgeArea() {
        return $this->belongsTo('App\Models\KnowledgeArea');
    }

    public function userGraduation() {
        return $this->belongsTo('App\Models\UserGraduation', 'graduation_id');
    }
}
