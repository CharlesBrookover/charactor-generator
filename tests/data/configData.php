<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 11/7/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

$configYaml = <<<EOF
paths:
  templates: '/templates'
  src: '/src'
databases:
  db1:
    host: 'db1'
  db2:
    host: 'db2'
EOF;

$configArray = [
    'paths'     => [
        'templates' => '/templates',
        'src'       => '/src',
    ],
    'databases' => [
        'db1' => [
            'host' => 'db1',
        ],
        'db2' => [
            'host' => 'db2',
        ],
    ],
];

$badConfigYaml = <<< EOF
dashboard "Variables example":
  - h1 text: Variables Example
  -       dropdown my_var=pie:
  - {"value": pie, "text": "Pie chart"}
  - {"value": bar, "text": "Bar chart"}
  p text: "Selected chart type: \${my_var}"
EOF;
