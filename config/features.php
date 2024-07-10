<?php
declare(strict_types=1);

return [
    'Features' => [
        'organizations:vip' => [
            'segments' => [
                [
                    'name' => 'internal test',
                    'conditions' => [
                        [
                            'property' => 'organization_slug',
                            'op' => 'in',
                            'value' => ['cakephp'],
                        ],
                        [
                            'property' => 'user_email',
                            'op' => 'in',
                            'value' => ['owner@example.com'],
                        ],
                    ],
                    'rollout' => 100,
                ],
                [
                    'name' => 'vip',
                    'conditions' => [
                        [
                            'property' => 'organization_slug',
                            'op' => 'in',
                            'value' => ['acme'],
                        ],
                    ],
                    'rollout' => 5,
                ],
            ],
        ],
    ],
];
