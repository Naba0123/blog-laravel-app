<?php

return [
    'error_class' => [
        \App\Exceptions\CriticalException::class => 'danger',
        \App\Exceptions\WarningException::class => 'warning',
        \App\Exceptions\InfoException::class => 'info',
        'default' => 'danger',
    ]
];
