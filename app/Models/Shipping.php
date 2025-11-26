<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Shipping extends Model
{
    use Translatable;

    protected $fillable = ['price']; // non-translatable fields

    public $translatedAttributes = ['name', 'description'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
