<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeAdmin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    public function node() {
        return $this->hasOne('App\Node', 'administrator_id');
    }
}
