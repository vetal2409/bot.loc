<?php
return [
    'scheduler' => [
        'imagePath' => __DIR__ . '/../web/images',
        'allowedTypes' => [IMAGETYPE_JPEG, IMAGETYPE_PNG],
    ],
    'resizer' => [
        'format' => 'jpg',
        'width' => '640',
        'height' => '640',
        'background' => '#ffffff',
        'imagePath' => __DIR__ . '/../web/images_resized',
    ],
    'monitoring' => [
        'queues' => ['resize', 'upload', 'done', 'failed'],
    ],
    'autoload' => function ($className) {
        if (preg_match('/\\\\/', $className)) {
            $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        }
        $path = __DIR__ . "/../{$className}.php";
        if (file_exists($path)) {
            require_once($path);
        }
    }
];
