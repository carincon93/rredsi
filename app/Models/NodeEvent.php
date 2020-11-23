<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeEvent extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'node_id',
    ];

    public function isEvent() {
        return $this->belongsTo('App\Models\Event', 'id');
    }

    public function node() {
        return $this->belongsTo('App\Models\Node');
    }
}
