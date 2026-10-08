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
        'category_id',
    ];

    /**
     * Egy termék egy kategóriához tartozik.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Szépen formázott alkoholtartalom: "4,5%" vagy "40%".
     */
    public function getPercentageLabelAttribute(): string
    {
        $value = number_format((float) $this->percentage, 1, ',', '');

        return rtrim(rtrim($value, '0'), ',') . '%';
    }

    /**
     * Az alkoholtartalom-csík szélessége százalékban (60%-os alkoholtartalom = teli csík).
     */
    public function getPercentageWidthAttribute(): float
    {
        return round(min(100, ((float) $this->percentage / 60) * 100), 1);
    }

    /**
     * Erősség szintje a csík színezéséhez: low / mid / high.
     */
    public function getStrengthAttribute(): string
    {
        $value = (float) $this->percentage;

        return match (true) {
            $value < 8  => 'low',
            $value < 25 => 'mid',
            default     => 'high',
        };
    }
}
