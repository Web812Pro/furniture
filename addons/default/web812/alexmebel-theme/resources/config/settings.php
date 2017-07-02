<?php

use Anomaly\UsersModule\Role\RoleModel;

return [
    'notifiable_role' => [
        'bind'        => 'web812.theme.alexmebel::notifiable_role',
        'env'         => 'NOTIFIABLE_ROLE',
        'required'    => true,
        'placeholder' => false,
        'type'        => 'anomaly.field_type.relationship',
        'config'      => [
            'default_value' => 1,
            'related'       => RoleModel::class,
            'mode'          => 'lookup',
        ],
    ],
];
