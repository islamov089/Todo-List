<?php



return [
    'item' => [
        'class' => \Modules\Item\Models\Item::class,
        'graph' => 'item',
        'property_path' => 'status',
        'states' => [
            'draft',
            'pending',
            'in-progress',
            'done',
        ],
        'transitions' => [
            'start_pending' => [
                'from' => ['draft'],
                'to' => 'pending',
            ],
            'start_in_progress' => [
                'from' => ['pending'],
                'to' => 'in-progress',
            ],
            'complete' => [
                'from' => ['in-progress'],
                'to' => 'done',
            ],
        ],
        'callbacks' => [
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory',
                ],
            ],
        ],
    ],
];
