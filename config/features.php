<?php
declare(strict_types=1);

return [
    'Features' => [
        'organzations:tasks' => [
            'segments' => [
                [
                    'name' => 'vip',
                    'conditions' => [
                        [
                            'property' => 'organization_slug',
                            'op' => 'in',
                            'value' => ['acme'],
                        ],
                    ],
                    'rollout' => 100,
                ],
            ],
        ],
    ],
];
