<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nit',
        'name',
        'address',
        'cellphone_number',
        'document_number',
        'email',
        'data_authorization',
    ];


    public function user() {
        return $this->hasOne('App\Models\User', 'nit_business');
    }
}
