<?php

// Csak a projektben használt üzenetek vannak magyarul, a többi az angol (fallback) szövegekre esik vissza.
return [
    'required' => 'A(z) :attribute megadása kötelező.',
    'string'   => 'A(z) :attribute csak szöveg lehet.',
    'numeric'  => 'A(z) :attribute csak szám lehet (pl. 4,5).',
    'exists'   => 'A kiválasztott :attribute érvénytelen.',
    'max'      => [
        'string' => 'A(z) :attribute legfeljebb :max karakter hosszú lehet.',
    ],
    'between'  => [
        'numeric' => 'A(z) :attribute értéke :min és :max között kell, hogy legyen.',
    ],

    'attributes' => [
        'name'        => 'név',
        'percentage'  => 'alkoholtartalom',
        'category_id' => 'kategória',
    ],
];
