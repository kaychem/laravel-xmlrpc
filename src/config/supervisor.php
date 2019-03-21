<?php
/**
 * 配置
 * User: kay
 * Date: 2019/3/20
 * Time: 4:35 PM
 */

return [
    'server' => env('SUPERVISOR_SERVER', 'http://127.0.0.1'),
    'port' => env('SUPERVISOR_PORT', 9001),
    'user' => env('SUPERVISOR_USER'),
    'password' => env('SUPERVISOR_PASSWORD')
];