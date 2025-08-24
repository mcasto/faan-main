<?php
return [
    'meta' => [
        'title' => 'Animal Rescue and Adoption, donations to save animals',
        'description' => 'Donations -  Donate to Save Animals in Ecuador',
        'keywords' => 'donate to help save animals in Ecuador,FAAN Ecuador',
        'ogTitle' => 'Animal Rescue and Adoption, donations to save animals',
        'ogDescription' => 'donate to help save animals in Ecuador,FAAN Ecuador',
        'ogLocale' => 'en_US'
    ],
    'header' => 'Help the Animals of Cuenca, Ecuador',
    'subtitle' => 'Please donate to FAAN (Funcdación Familia Amor Animal) and help our dogs get a "New Leash On Life"',
    'contribution-header' => 'We welcome any and all contributions ...',
    'contribution-info' => file_get_contents(__DIR__ . '/donations/contribution-info.html'),
    'join-header' => 'Consider:',
    'join-bullets' => file_get_contents(__DIR__ . '/donations/join-bullets.html'),
    'red-carpet' => [
        'image' => '/images/paws-on-red-carpet.jpeg',
        'caption' => 'In 2025, our donors will be recognized at Gala FAAN-TASTICA, Old Hollywood as "Paws on the Red Carpet." Your recognition will then be honored at the new sanctuary!',
    ],
    'paw-images' => [
        '/images/paws-bronze.png',
        '/images/paws-silver.png',
        '/images/paws-gold.png',
        '/images/paws-platinum.png'
    ],
    'form-header' => "All donations to FAAN, unless specifically designated, are applied to the FAAN General fund which supports both the building of the new sanctuary and the support and medical care of the approximately 150 animals in our care.",
    'form-title' => 'Donation Form',
    'form-disclaimer' => "This form is only for FAAN's records. We need this information to properly track the donations we receive.",
    'donation-method-header' => 'Choose your donation method',
    'donation-methods' => [
        ['label' => 'Credit Card / PayPal', 'value' => 'cc'],
        ['label' => 'Bank Transfer', 'value' => 'transfer'],
        ['label' => 'Pickup by FAAN Volunteer', 'value' => 'pickup'],
    ],
    'form-fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'amount' => 'Donation Amount',
        'consent' => 'I consent to have this website hold my personal data solely for communication purposes and understand that it will not be shared with any third parties.'
    ],
    'form-buttons' => [
        'cancel' => 'Cancel',
        'continue' => 'Continue'
    ],
    'recaptcha-disclaimer' => file_get_contents(__DIR__ . '/donations/recaptcha-disclaimer.html'),
    'credit-dialog' => file_get_contents(__DIR__ . '/donations/donation-credit.html'),
    'pickup-dialog' => file_get_contents(__DIR__ . '/donations/donation-pickup.html'),
    'transfer-dialog' => file_get_contents(__DIR__ . '/donations/donation-transfer.html')
];
