<?php

return array (
  'meta' => 
  array (
    'title' => 'Legacy Giving - Donaciones - Fundación FAAN',
    'description' => 'Legacy Ded para perros en Ecuador',
    'keywords' => 'Legacy Giving, heredero, voluntario, rescate y adopción de animales, FAAN',
    'ogTitle' => 'Voluntario para salvar animales - Fundación FAAN',
    'ogDescription' => 'Legacy Ded para perros en Ecuador',
    'ogLocale' => 'EN_US',
  ),
  'header-area' => 
  array (
    'header' => 'Legacy Deding',
    'subtitle' => 'Considere irse al bienestar animal al incluir FAAN (<strong> Fundación Familia Amor Animal </strong>) en sus planes finales de patrimonio.',
    'image' => '/Images/Legacy-Giving-01.jpeg',
  ),
  'left-column' => 
  array (
    'why' => 
    array (
      'header' => 'Por qué las cosas planificadas para dar asuntos',
      'text' => 'La gran noticia sobre las donaciones planificadas es que no necesita ser rico para plantar una semilla para la futura sostenibilidad de FAAN.',
      'image' => '/Images/Legacy-Giving-02.jpeg',
    ),
    'society' => 'Únase a la Sociedad Legacy de Faan </strong> y sea reconocido hoy por una causa en la que cree. (Vea la información de contacto a continuación).',
    'guide' => 
    array (
      'header' => 'Guía de faan para donaciones planificadas',
      'image' => '/Images/planning.png',
      'plan' => 
      array (
        0 => 'Complete la donación de FAAN <strong> Legacy </strong> y <strong> formularios para dar intención </strong>.',
        1 => 'Determine el tipo de regalo que desea hacer a FAAN (legado absoluto de una cantidad específica en dólares, activos específicos o porcentaje de patrimonio).',
        2 => 'Consulte con su fiscal ecuatoriano y de los Estados Unidos (si corresponde) dependiendo de la ubicación de los activos para el lenguaje legal correcto.',
        3 => 'Incluya <strong> faan (Fundación Familia Amor Animal) </strong> en su voluntad final y testamento.',
      ),
    ),
  ),
  'right-column' => 
  array (
    'heir' => 
    array (
      'header' => 'El programa heredero: Artículo de nuestra revista',
      'text' => 'Lea un testimonio de primera mano sobre el legado.',
      'buttonLabel' => 'Leer / descargar pdf',
      'pdf' => '/downloadable/extracted-articles/heirofthedog/heirofthedog.pdf',
    ),
    'pledge' => 
    array (
      'header' => 'Promesa de Faan a los donantes',
      'items' => 
      array (
        0 => 'Los legados a FAAN se utilizan para la sostenibilidad organizacional del refugio a menos que el donante designe para un programa o servicio de FAAN específico. Estos fondos están estrechamente invertidos y asignados por el acuerdo de la Junta Combinada de FAAN y la Junta Asesora de los Estados Unidos.',
        1 => 'Al recibir una intención heredada, los donantes serán reconocidos como miembros de la sociedad heredada de FAAN a menos que se solicite una donación anónima.',
      ),
    ),
  ),
  'form-config' => 
  array (
    'title' => 'Donación heredada e intención de donaciones planificadas',
    'buttonLabel' => 'Entregar',
    'legal_name_of_donor' => 
    array (
      'label' => 'Nombre legal del donante',
      'type' => 'texto',
    ),
    'phone' => 
    array (
      'label' => 'Número de teléfono',
      'type' => 'Tel',
      'mask' => '(###) ### - ####',
    ),
    'cedula_passport' => 
    array (
      'label' => 'Cédula o número de pasaporte',
      'type' => 'número',
    ),
    'email' => 
    array (
      'label' => 'Dirección de correo electrónico',
      'type' => 'correo electrónico',
    ),
    'address' => 
    array (
      'label' => 'DIRECCIÓN',
      'type' => 'textea',
    ),
    'special_instructions' => 
    array (
      'label' => 'Instrucciones especiales',
      'type' => 'textea',
    ),
    'recognized' => 
    array (
      'label' => 'Me gustaría ser reconocido como miembro de la Sociedad Legal de FAAN',
      'type' => 'caja',
    ),
    'donation_type' => 
    array (
      'label' => 'Tipo de donación',
      'type' => 'seleccionar',
      'options' => 
      array (
        0 => 
        array (
          'label' => 'Legado directo (cantidad fija de $)',
          'value' => 'fijado',
        ),
        1 => 
        array (
          'label' => 'Legado absoluto (% del patrimonio)',
          'value' => 'porcentaje',
        ),
        2 => 
        array (
          'label' => 'Donación de activos específicos',
          'value' => 'donación',
        ),
      ),
      'followups' => 
      array (
        'fixed' => 
        array (
          'label' => '$ Cantidad',
          'type' => 'número',
        ),
        'percentage' => 
        array (
          'label' => '% de patrimonio',
          'type' => 'número',
        ),
        'donation' => 
        array (
          'label' => 'Activos específicos',
          'type' => 'textea',
        ),
      ),
    ),
    'consent' => 
    array (
      'label' => 'Tengo su consentimiento para que este sitio web mantenga mis datos personales únicamente para fines de comunicación y comprendo que no se compartirá con terceros.',
      'type' => 'caja',
    ),
  ),
  'recaptcha' => 'Este sitio está protegido por Recaptcha y Google <a href = \'https: //policies.google.com/privacy\' target = \'_ en blanco\'> Política de privacidad </a> y <a href = \'https: //policies.google.com/terms\' Target = \'_ en blanco\'> Términos de servicio </a> Aplicar.',
);
