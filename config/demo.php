<?php

return [
    /*
     * Cuentas deliberadamente ficticias para recorrer la demo. No hay
     * integración con directorio, biométricos ni datos de clientes reales.
     */
    'users' => [
        [
            'id' => 'admin',
            'name' => 'Andrea Castillo',
            'email' => 'andrea.castillo@saferoom.demo',
            'password' => 'Admin2026!',
            'role' => 'Administrador',
            'initials' => 'AC',
        ],
        [
            'id' => 'reception',
            'name' => 'Marco Rodríguez',
            'email' => 'marco.rodriguez@saferoom.demo',
            'password' => 'Recepcion2026!',
            'role' => 'Recepción',
            'initials' => 'MR',
        ],
        [
            'id' => 'finance',
            'name' => 'Elena Vargas',
            'email' => 'elena.vargas@saferoom.demo',
            'password' => 'Finanzas2026!',
            'role' => 'Finanzas',
            'initials' => 'EV',
        ],
        [
            'id' => 'vault',
            'name' => 'Sergio Paredes',
            'email' => 'boveda@saferoom.demo',
            'password' => 'Boveda2026!',
            'role' => 'Encargado de bóveda',
            'initials' => 'SP',
        ],
        [
            'id' => 'c4',
            'name' => 'Valeria Cárdenas',
            'email' => 'c4@saferoom.demo',
            'password' => 'C4Seguro2026!',
            'role' => 'Operador C4',
            'initials' => 'C4',
        ],
    ],

    'permissions' => [
        'Administrador' => ['*'],
        'Recepción' => ['home', 'requests', 'form', 'boxes', 'tenants', 'tenant', 'contracts', 'contract', 'renewals', 'cancellations', 'documents'],
        'Finanzas' => ['home', 'finance', 'reports'],
        'Encargado de bóveda' => ['access'],
        'Operador C4' => ['access'],
    ],
];
