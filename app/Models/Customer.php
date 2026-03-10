<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name',
        'mobile',
        'no_of_visit'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
