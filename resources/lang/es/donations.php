<?php
return [
    'meta' => [
        'title' => 'Rescate y Adopción de Animales, donaciones para salvar animales',
        'description' => 'Donaciones - Dona para Salvar Animales en Ecuador',
        'keywords' => 'dona para ayudar a salvar animales en Ecuador,FAAN Ecuador',
        'ogTitle' => 'Rescate y Adopción de Animales, donaciones para salvar animales',
        'ogDescription' => 'dona para ayudar a salvar animales en Ecuador,FAAN Ecuador',
        'ogLocale' => 'es_US'
    ],
    'header' => 'Ayuda a los animales de Cuenca, Ecuador',
    'subtitle' => 'Por favor, haga una donación a FAAN (Funcdación Familia Amor Animal) y ayude a nuestros perros a obtener una "nueva correa para la vida" y a construir el nuevo y moderno Santuario de Súper Perros, ¡donde los desamparados se convierten en súper perros!',
    'contribution-header' => 'Damos la bienvenida a todas y cada una de las contribuciones...',
    'contribution-info' => file_get_contents(__DIR__ . '/donations/contribution-info.html'),
    'join-header' => 'Considerar:',
    'join-bullets' => file_get_contents(__DIR__ . '/donations/join-bullets.html'),
    'red-carpet' => [
        'image' => '/images/paws-on-red-carpet.jpeg',
        'caption' => 'En 2025, nuestros donantes serán reconocidos en la Gala FAAN-TASTICA, Old Hollywood como "Paws on the Red Carpet". ¡Su reconocimiento será honrado en el nuevo santuario!',
    ],
    'paw-images' => [
        '/images/paws-bronze.png',
        '/images/paws-silver.png',
        '/images/paws-gold.png',
        '/images/paws-platinum.png'
    ],
    'form-header' => "Todas las donaciones a FAAN, a menos que se designen específicamente, se aplican al fondo general de FAAN que apoya tanto la construcción del nuevo santuario como el apoyo y la atención médica de los aproximadamente 150 animales bajo nuestro cuidado.",
    'form-title' => 'Formulario de donación',
    'form-disclaimer' => "Este formulario es sólo para los registros de la FAAN. Necesitamos esta información para realizar un seguimiento adecuado de las donaciones que recibimos.",
    'donation-method-header' => 'Elige tu método de donación',
    'donation-methods' => [
        ['label' => 'Tarjeta de crédito/PayPal', 'value' => 'cc'],
        ['label' => 'Transferencia bancaria', 'value' => 'transfer'],
        ['label' => 'Recogida por voluntario FAAN', 'value' => 'pickup'],
    ],
    'form-fields' => [
        'name' => 'Nombre',
        'email' => 'Correo Electrónico',
        'amount' => 'Monto de la donación',
        'comments' => 'Comentarios / Mensajes',
        'consent' => 'Doy mi consentimiento para que este sitio web conserve mis datos personales únicamente con fines de comunicación y entiendo que no se compartirán con terceros.'
    ],
    'form-buttons' => [
        'cancel' => 'Cancelar',
        'continue' => 'Continuar'
    ],
    'recaptcha-disclaimer' => file_get_contents(__DIR__ . '/donations/recaptcha-disclaimer.html'),
    'credit-dialog' => file_get_contents(__DIR__ . '/donations/donation-credit.html'),
    'pickup-dialog' => file_get_contents(__DIR__ . '/donations/donation-pickup.html'),
    'transfer-dialog' => file_get_contents(__DIR__ . '/donations/donation-transfer.html')
];
