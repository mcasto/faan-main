<?php

return array(
  'meta' =>
  array(
    'title' => 'Legacy Giving - Donaciones - Fundación FAAN',
    'description' => 'Legacy Ded para perros en Ecuador',
    'keywords' => 'Legacy Giving, heredero, voluntario, rescate y adopción de animales, FAAN',
    'ogTitle' => 'Voluntario para salvar animales - Fundación FAAN',
    'ogDescription' => 'Legacy Ded para perros en Ecuador',
    'ogLocale' => 'EN_US',
  ),
  'header-area' =>
  array(
    'header' => 'Legacy Deding',
    'subtitle' => '<p>Consider leaving to animal welfare by including FAAN (<strong>Fundacion Familia Amor Animal</strong>) in your final estate plans.</p>
',
    'image' => '/Images/Legacy-Giving-01.jpeg',
  ),
  'left-column' =>
  array(
    'why' =>
    array(
      'header' => 'Por qué las cosas planificadas para dar asuntos',
      'text' => 'La gran noticia sobre las donaciones planificadas es que no necesita ser rico para plantar una semilla para la futura sostenibilidad de FAAN.',
      'image' => '/Images/Legacy-Giving-02.jpeg',
    ),
    'society' => '<p>Join <strong>FAAN\'s Legacy Society</strong> and be recognized today for a cause you believe in. (See contact information below.)</p>
',
    'guide' =>
    array(
      'header' => 'Guía de faan para donaciones planificadas',
      'image' => '/Images/planning.png',
      'plan' =>
      array(
        0 => '<p>Complete FAAN\'s <strong>Legacy Donation</strong> and <strong>Planned Giving Intention</strong> forms.</p>
',
        1 => 'Determine el tipo de regalo que desea hacer a FAAN (legado absoluto de una cantidad específica en dólares, activos específicos o porcentaje de patrimonio).',
        2 => 'Consulte con su fiscal ecuatoriano y de los Estados Unidos (si corresponde) dependiendo de la ubicación de los activos para el lenguaje legal correcto.',
        3 => '<p>Include <strong>FAAN (Fundaci&oacute;n Familia Amor Animal)</strong> in your final will and testament.</p>
',
      ),
    ),
  ),
  'right-column' =>
  array(
    'heir' =>
    array(
      'header' => 'El programa heredero: Artículo de nuestra revista',
      'text' => 'Lea un testimonio de primera mano sobre el legado.',
      'buttonLabel' => 'Leer / descargar pdf',
      'pdf' => '/downloadable/extracted-articles/heirofthedog/heirofthedog.pdf',
    ),
    'pledge' =>
    array(
      'header' => 'Promesa de Faan a los donantes',
      'items' =>
      array(
        0 => 'Los legados a FAAN se utilizan para la sostenibilidad organizacional del santuario a menos que el donante designe para un programa o servicio de FAAN específico. Estos fondos están estrechamente invertidos y asignados por el acuerdo de la Junta Combinada de FAAN y la Junta Asesora de los Estados Unidos.',
        1 => 'Al recibir una intención heredada, los donantes serán reconocidos como miembros de la sociedad heredada de FAAN a menos que se solicite una donación anónima.',
      ),
    ),
  ),
  'form-config' =>
  array(
    'title' => 'Donación heredada e intención de donaciones planificadas',
    'buttonLabel' => 'Entregar',
    'legal_name_of_donor' =>
    array(
      'label' => 'Nombre legal del donante',
      'type' => 'texto',
    ),
    'phone' =>
    array(
      'label' => 'Número de teléfono',
      'type' => 'Tel',
      'mask' => '(###) ### - ####',
    ),
    'cedula_passport' =>
    array(
      'label' => 'Cédula o número de pasaporte',
      'type' => 'número',
    ),
    'email' =>
    array(
      'label' => 'Dirección de correo electrónico',
      'type' => 'correo electrónico',
    ),
    'address' =>
    array(
      'label' => 'DIRECCIÓN',
      'type' => 'textea',
    ),
    'special_instructions' =>
    array(
      'label' => 'Instrucciones especiales',
      'type' => 'textea',
    ),
    'recognized' =>
    array(
      'label' => 'Me gustaría ser reconocido como miembro de la Sociedad Legal de FAAN',
      'type' => 'caja',
    ),
    'donation_type' =>
    array(
      'label' => 'Tipo de donación',
      'type' => 'seleccionar',
      'options' =>
      array(
        0 =>
        array(
          'label' => 'Legado directo (cantidad fija de $)',
          'value' => 'fijado',
        ),
        1 =>
        array(
          'label' => 'Legado absoluto (% del patrimonio)',
          'value' => 'porcentaje',
        ),
        2 =>
        array(
          'label' => 'Donación de activos específicos',
          'value' => 'donación',
        ),
      ),
      'followups' =>
      array(
        'fixed' =>
        array(
          'label' => '$ Cantidad',
          'type' => 'número',
        ),
        'percentage' =>
        array(
          'label' => '% de patrimonio',
          'type' => 'número',
        ),
        'donation' =>
        array(
          'label' => 'Activos específicos',
          'type' => 'textea',
        ),
      ),
    ),
    'consent' =>
    array(
      'label' => 'Tengo su consentimiento para que este sitio web mantenga mis datos personales únicamente para fines de comunicación y comprendo que no se compartirá con terceros.',
      'type' => 'caja',
    ),
  ),
  'recaptcha' => '<p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
',
);
