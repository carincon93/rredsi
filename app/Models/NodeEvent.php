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
        'is_annual_event',
    ];

    public function event() {
        return $this->belongsTo('App\Models\Event', 'id');
    }

    public function node() {
        return $this->belongsTo('App\Models\Node');
    }

    public function annualNodeEvent() {
        return $this->hasOne('App\Models\AnnualNodeEvent', 'id');
    }
}
