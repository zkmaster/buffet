<?php

$version_routes = [];

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'v1' . DIRECTORY_SEPARATOR . 'test.php')) {
    $version_routes = array_merge($version_routes, require __DIR__ . DIRECTORY_SEPARATOR . 'v1' . DIRECTORY_SEPARATOR . 'test.php');
}

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'v1' . DIRECTORY_SEPARATOR . 'user.php')) {
    $version_routes = array_merge($version_routes, require __DIR__ . DIRECTORY_SEPARATOR . 'v1' . DIRECTORY_SEPARATOR . 'user.php');
}

return $version_routes;