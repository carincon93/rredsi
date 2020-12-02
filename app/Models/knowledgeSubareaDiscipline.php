<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class knowledgeSubareaDiscipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'knowledge_subarea_id',
    ];

    public function knowledgeSubarea() {
        return $this->belongsTo('App\Models\KnowledgeSubarea');
    }
}
