<?php

return array(
    'caches' => array(
        'Cache' => array(
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => true,
                ),
                'serializer'
            ),
            'adapter' => 'filesystem',
            'ttl'     => 86400,
            'options' => array(
                'cache_dir' => __DIR__ . '/../../data/cache/')
        ),
    ),
);
