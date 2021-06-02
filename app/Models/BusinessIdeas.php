<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessIdeas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'person_in_charge',
        'have_tools',
        'tools',
        'have_budget',
        'budget',
        'condition',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    public function replaceWithRelationshipModelName(){
        return $this->belongsTo('App\Models\replaceWithRelationshipModelName');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business');
    }
}
