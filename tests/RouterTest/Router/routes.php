<?php

return [
    'calc/{param1}' => [
        'calculator:test',
        'param1' => 'INT:3'
    ],

    'calc' => [
        'calculator:calculate'
    ],

    'fake/{param1}/{param2}' => [
        'fake:dummy',
        'param1' => 'STR',
        'param2' => 'MIX:10'
    ]
];