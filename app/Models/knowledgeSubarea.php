<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeSubarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'knowledge_area_id',
    ];

    public function knowledgeArea() {
        return $this->belongsTo('App\Models\KnowledgeArea');
    }

    public function knowledgeSubareaDisciplines() {
        return $this->hasMany('App\Models\KnowledgeSubareaDiscipline');
    }
}
