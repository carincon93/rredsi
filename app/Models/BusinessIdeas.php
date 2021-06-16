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
        'business_id',
        'name',
        'description',
        'type',
        'have_tools',
        'how_many_tools',
        'have_money',
        'how_many_money',
        'condition',
    ];

    public function user() {
        return $this->hasOne('App\Models\User', 'nit_business');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business','business_id', 'id');
    }

    public function replaceWithRelationshipModelName()
    {
        return $this->belongsTo('App\Models\replaceWithRelationshipModelName');
    }
}
