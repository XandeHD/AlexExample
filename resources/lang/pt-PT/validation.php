<?php 


return [
   'password' => [
        'letters' => 'A palavra-passe deve conter pelo menos uma letra.',
        'mixed' => 'A palavra-passe deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers' => 'A palavra-passe deve conter pelo menos um número.',
        'symbols' => 'A palavra-passe deve conter pelo menos um símbolo.',
        'uncompromised' => 'A palavra-passe apareceu numa fuga de dados. Por favor escolhe uma diferente.',
    ],
    'confirmed' => 'A confirmação do campo :attribute não coincide.',
    'min' => [
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
    ],
    'attributes' => [
        'password' => 'palavra-passe',
    ],
];