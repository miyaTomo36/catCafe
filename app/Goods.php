<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'price' => 'required | integer',
        'detail' => 'required',
    );
}
