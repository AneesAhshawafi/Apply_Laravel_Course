<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'flights';
    protected $fillable = [
        'name',
        'active',
    ];
    function scopeactive($query){
        return $query->where('active',1);
    }
    public function destination(){
        return $this->hasOne(Flight_Country::class);
    }

}
