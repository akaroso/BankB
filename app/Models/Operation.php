<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

   

    protected $fillable = [
        'type',
        'amount',
        'status',        
    ];


    public function account()
    {
        return $this->belongsTo('App\Models\Account');        
    }
}
