<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/themes/educational/blueprints.yaml',
    'modified' => 1791210227,
    'size' => 1521,
    'data' => [
        'name' => 'Educational',
        'slug' => 'educational',
        'type' => 'theme',
        'version' => '0.1.0',
        'description' => 'For Educational Purposes',
        'icon' => 'book',
        'author' => [
            'name' => 'Kamil Żuk',
            'email' => 'dev.ncoder.pl@gmail.com'
        ],
        'homepage' => 'https://github.com/kamil-Żuk/grav-theme-educational',
        'keywords' => 'heme, docs, modern, fast, responsive, html5, css3',
        'bugs' => 'https://github.com/kamil-Żuk/grav-theme-educational/issues',
        'license' => 'MIT',
        'compatibility' => [
            'grav' => [
                0 => '2.0'
            ]
        ],
        'dependencies' => [
            0 => [
                'name' => 'grav',
                'version' => '>=2.0.0'
            ]
        ],
        'form' => [
            'validation' => 'loose',
            'fields' => [
                'top_level_version' => [
                    'type' => 'toggle',
                    'label' => 'Top Level Version',
                    'highlight' => 1,
                    'default' => 0,
                    'options' => [
                        1 => 'Enabled',
                        0 => 'Disabled'
                    ],
                    'validate' => [
                        'type' => 'bool'
                    ]
                ],
                'home_url' => [
                    'type' => 'text',
                    'label' => 'Home URL',
                    'placeholder' => 'http://getgrav.org',
                    'validate' => [
                        'type' => 'text'
                    ]
                ],
                'google_analytics_code' => [
                    'type' => 'text',
                    'label' => 'Google Analytics Code',
                    'placeholder' => 'UA-XXXXXXXX-X',
                    'validate' => [
                        'type' => 'text'
                    ]
                ],
                'github.position' => [
                    'type' => 'select',
                    'size' => 'medium',
                    'classes' => 'fancy',
                    'label' => 'GitHub Position',
                    'options' => [
                        'top' => 'Top',
                        'bottom' => 'Bottom',
                        0 => false
                    ]
                ],
                'github.tree' => [
                    'type' => 'text',
                    'label' => 'GitHub Tree',
                    'default' => 'https://github.com/getgrav/grav-skeleton-rtfm-site/blob/develop/'
                ],
                'github.commits' => [
                    'type' => 'text',
                    'label' => 'GitHub Commits',
                    'default' => 'https://github.com/getgrav/grav-skeleton-rtfm-site/commits/develop/'
                ]
            ]
        ]
    ]
];
