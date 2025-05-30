<?php 


return [
   'password' => [
        'letters' => 'The password must contain at least one letter.',
        'mixed' => 'The password must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The password must contain at least one number.',
        'symbols' => 'The password must contain at least one symbol.',
        'uncompromised' => 'The given password has appeared in a data leak. Please choose a different password.',
    ],
    'confirmed' => 'The :attribute confirmation does not match.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'attributes' => [
        'password' => 'password',
    ],
];