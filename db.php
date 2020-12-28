<?php

file_put_contents('data.json', json_encode(
    [
        ['name' => 'Katinukas', 'email' => 'kati@nas.lt', 'pass' => md5('123')],
        ['name' => 'Suniukas', 'email' => 'suniu@kas.lt', 'pass' => md5('456')]
]
));