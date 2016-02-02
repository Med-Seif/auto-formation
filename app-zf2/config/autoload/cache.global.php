<?php

return array(
    'caches' => array(
        'MyCache' => array(
            'plugins'   => array(
                'exception_handler' => array(
                    'throw_exceptions' => true,
                ),
            ),
            'adapter'   => 'filesystem',
            'ttl'       => 86400,
            'cache_dir' => __DIR__ . '/../../data/cache/'
        ),
    ),
);
