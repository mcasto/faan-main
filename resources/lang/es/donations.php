<?php
return [
    'meta' => [
        'title' => 'Rescate y adopción de animales, donaciones para salvar animales',
        'description' => 'Donaciones: done para salvar animales en Ecuador',
        'keywords' => 'donar para ayudar a salvar animales en Ecuador, Faan Ecuador',
        'ogTitle' => 'Rescate y adopción de animales, donaciones para salvar animales',
        'ogDescription' => 'donar para ayudar a salvar animales en Ecuador, Faan Ecuador',
        'ogLocale' => 'EN_US'
    ],
    'header' => 'Ayuda a los animales de Cuenca, Ecuador',
    'subtitle' => 'Por favor, done a Faan (Funcidacia Familia Amor Animal) y ayude a nuestros perros a obtener una "nueva correa en la vida"',
    'contribution-header' => 'Agradecemos todas y cada una de las contribuciones ...',
    'contribution-info' => file_get_contents(__DIR__ . '/donations/contribution-info.html'),
    'join-header' => 'Considerar:',
    'join-bullets' => file_get_contents(__DIR__ . '/donations/join-bullets.html'),
    'red-carpet' => [
        'image' => '/Images/Paws-on-Red-carpet.jpeg',
        'caption' => 'En 2025, nuestros donantes serán reconocidos en Gala Faan-Tastica, Old Hollywood como "patas en la alfombra roja". ¡Su reconocimiento será honrado en el nuevo santuario!',
    ],
    'paw-images' => [
        '/images/paws-bronze.png',
        '/images/paws-silver.png',
        '/images/paws-gold.png',
        '/images/paws-platinum.png'
    ],
    'form-header' => "Todas las donaciones a FAAN, a menos que se designen específicamente, se aplican al Fondo General de FAAN que respalda tanto la construcción del nuevo santuario como el apoyo y la atención médica de los aproximadamente 150 animales a nuestro cuidado.",
    'form-title' => 'Formulario de donación',
    'form-disclaimer' => "Esta forma es solo para los registros de FAAN. Necesitamos esta información para rastrear adecuadamente las donaciones que recibimos.",
    'donation-method-header' => 'Elija su método de donación',
    'donation-methods' => [
        ['label' => 'Tarjeta de crédito / PayPal', 'value' => 'cc'],
        ['label' => 'Transferencia bancaria', 'value' => 'transferir'],
        ['label' => 'Recogida por voluntario de FAAN', 'value' => 'levantar'],
    ],
    'form-fields' => [
        'name' => 'Nombre',
        'email' => 'Correo Electrónico',
        'amount' => 'Cantidad de donación',
        'consent' => 'Tengo su consentimiento para que este sitio web mantenga mis datos personales únicamente para fines de comunicación y comprendo que no se compartirá con terceros.'
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
