<?php 


return [
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre.',
        'mixed' => 'Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.',
        'numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
        'symbols' => 'Le mot de passe doit contenir au moins un symbole.',
        'uncompromised' => 'Ce mot de passe a été trouvé dans une fuite de données. Veuillez en choisir un autre.',
    ],
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],
    'attributes' => [
        'password' => 'mot de passe',
        'email' => 'email',
        'name' => 'nom',
    ],
];