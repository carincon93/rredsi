<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
        
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        protected $fillable = [
        'Nombre',
        'Descripcion',
        'Foto',
        'id_business',
        
        ];
    
    public function authors($id_product,$id_business) {
        return $this->where([['id','=',$id_product], ['id_business','=',$id_business]])->exists();
    }

}
