<?php 


return [
   'password' => [
        'letters' => 'Das Passwort muss mindestens einen Buchstaben enthalten.',
        'mixed' => 'Das Passwort muss mindestens einen Groß- und einen Kleinbuchstaben enthalten.',
        'numbers' => 'Das Passwort muss mindestens eine Zahl enthalten.',
        'symbols' => 'Das Passwort muss mindestens ein Symbol enthalten.',
        'uncompromised' => 'Dieses Passwort wurde in einem Datenleck gefunden. Bitte wähle ein anderes.',
    ],
    'confirmed' => 'Die Bestätigung des Feldes :attribute stimmt nicht überein.',
    'min' => [
        'string' => 'Das Feld :attribute muss mindestens :min Zeichen enthalten.',
    ],
    'attributes' => [
        'password' => 'Passwort',
        'email' => 'E-Mail',
        'name' => 'Name',
    ],
];