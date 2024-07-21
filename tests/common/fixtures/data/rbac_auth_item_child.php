<?php

return [
    [
        'parent' => 'user',
        'child' => 'editOwnModel',
    ],
    [
        'parent' => 'manager',
        'child' => 'loginToBackend',
    ],
    [
        'parent' => 'AC_Admin',
        'child' => 'manager',
    ],
    [
        'parent' => 'manager',
        'child' => 'user',
    ],
];
