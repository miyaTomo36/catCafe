<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'price' => 'required | integer',
        'feature' => 'required',
    );
}
