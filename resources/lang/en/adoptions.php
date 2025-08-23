<?php

return [
    'meta' => [
        'title' => 'Adopt a Dog to save animals - FAAN Foundation',
        'description' => 'Adopt and Rescue Dogs in Equador',
        'keywords' => 'volunteer,Animal Rescue and Adoption,FAAN',
        'ogTitle' => 'Volunteering to save animals - FAAN Foundation',
        'ogDescription' => 'Adopt and Rescue Dogs in Equador',
        'ogLocale' => 'en_US',
    ],
    'banner-left-header' => 'Adopt and Rescue',
    'banner-left-text' => "At the FAAN Foundation, we have many dogs dreaming of their Fur-ever homes. They range from adorable puppies to our senior dogs. We'll arrange for an adoption specialist to work with you and help you find your perfect match.",
    'banner-right-header' => "When you adopt from FAAN, your pet owner's benefits include:",
    'banner-right-text' => file_get_contents(__DIR__ . '/adoptions/banner-right-text.html'),
    'banner-bottom' => 'You may also volunteer as a Foster Parent to help us manage emergency
    placements',
    'adoptee-header' => file_get_contents(__DIR__ . '/adoptions/adoptee-header.html'),
];
