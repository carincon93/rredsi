<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'node_id',
    ];

    public function isEvent() {
        return $this->belongsTo('App\Event', 'id');
    }

    public function node() {
        return $this->belongsTo('App\Node');
    }
}
