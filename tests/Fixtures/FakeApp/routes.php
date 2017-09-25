<?php

return [
    'ABRouterTest\Fixtures\FakeApp\Controller' => [
        'fake/{param1}/{param2}' => [
            'fake:dummy',
            'param1' => 'STR',
            'param2' => 'MIX:10'
        ],
        'test' => [
            'fake:test'
        ]
    ]
];