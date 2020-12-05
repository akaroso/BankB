<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['number', 'balance'];


    public function user()
    {
        return $this->belongsTo('App\Models\User');        
    }
}
