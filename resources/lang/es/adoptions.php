<?php

return [
    'meta' => [
        'title' => 'Adoptar un perro para salvar animales - Fundación FAAN',
        'description' => 'Adoptar y rescatar perros en Ecuador',
        'keywords' => 'Voluntario, Rescate y Adopción de Animales, FAAN',
        'ogTitle' => 'Voluntario para salvar animales - Fundación FAAN',
        'ogDescription' => 'Adoptar y rescatar perros en Ecuador',
        'ogLocale' => 'EN_US',
    ],
    'banner-left-header' => 'Adoptar y rescate',
    'banner-left-text' => "En la Fundación Faan, tenemos muchos perros soñando con sus casas de piel. Van desde cachorros adorables hasta nuestros perros mayores. Organizaremos para que un especialista en adopción trabaje con usted y lo ayudaremos a encontrar su combinación perfecta.",
    'banner-right-header' => "Cuando adopta de FAAN, los beneficios del propietario de su mascota incluyen:",
    'banner-right-text' => file_get_contents(__DIR__ . '/adoptions/banner-right-text.html'),
    'banner-bottom' => 'También puede ser voluntario como padre adoptivo para ayudarnos a administrar la emergencia
    colocación',
    'adoptee-header' => file_get_contents(__DIR__ . '/adoptions/adoptee-header.html'),
];
