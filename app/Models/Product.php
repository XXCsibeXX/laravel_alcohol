<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Ebben a projektben nem használunk timestamp mezőket.
     */
    public $timestamps = false;

    /**
     * Tömegesen kitölthető mezők.
     */
    protected $fillable = [
        'name',
        'percentage',
        'category_id'
    ];

    /**
     * Egy város egy megyéhez tartozik.
     */
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}