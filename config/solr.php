<?php

return [
    'endpoint' => [
        'localhost' => [
            'host' => env('SOLR_HOST', '127.0.0.1'),
            'port' => env('SOLR_PORT', '8983'),
            'core' => env('SOLR_CORE', 'product')
        ]
    ]
];