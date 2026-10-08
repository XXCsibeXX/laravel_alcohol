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
     * Egy kategóriához több termék tartozhat.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * A kategória nevéhez illő ikon neve (a nézetekben: <x-icon :name="$category->icon" />).
     */
    public function getIconAttribute(): string
    {
        $name = mb_strtolower($this->name);

        return match (true) {
            str_contains($name, 'sör')                                                  => 'beer',
            str_contains($name, 'bor'), str_contains($name, 'pezsgő')                   => 'wine',
            str_contains($name, 'vodka'), str_contains($name, 'gin'),
            str_contains($name, 'whisky'), str_contains($name, 'rum'),
            str_contains($name, 'pálinka'), str_contains($name, 'tequila')              => 'martini',
            default                                                                     => 'glass',
        };
    }
}
