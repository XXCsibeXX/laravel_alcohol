<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Ebben a projektben nem használunk timestamp mezőket.
     */
    public $timestamps = false;

    /**
     * Tömegesen kitölthető mezők.
     */
    protected $fillable = ['name'];

    /**
     * Egy megyéhez több város tartozhat.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}