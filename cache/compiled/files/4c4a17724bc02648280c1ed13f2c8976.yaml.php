<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/themes/helios-bs/blueprints.yaml',
    'modified' => 1791224223,
    'size' => 1619,
    'data' => [
        'name' => 'Helios BS',
        'slug' => 'helios-bs',
        'type' => 'theme',
        'version' => '1.1.0',
        'description' => 'Nowoczesny motyw dokumentacji (3 kolumny, jasny/ciemny) inspirowany Helios i learn.getgrav.org, Bootstrap 5',
        'icon' => 'book',
        'author' => [
            'name' => 'Twoje Imie',
            'email' => 'ty@example.com'
        ],
        'license' => 'MIT',
        'dependencies' => [
            0 => [
                'name' => 'grav',
                'version' => '>=1.7.0'
            ]
        ],
        'form' => [
            'validation' => 'loose',
            'fields' => [
                'enabled' => [
                    'type' => 'toggle',
                    'label' => 'PLUGIN_ADMIN.PLUGIN_STATUS',
                    'highlight' => 1,
                    'default' => 1,
                    'options' => [
                        1 => 'PLUGIN_ADMIN.ENABLED',
                        0 => 'PLUGIN_ADMIN.DISABLED'
                    ],
                    'validate' => [
                        'type' => 'bool'
                    ]
                ],
                'current_version' => [
                    'type' => 'text',
                    'label' => 'Aktualna wersja dokumentacji',
                    'placeholder' => '2.x (Stable)'
                ],
                'versions' => [
                    'type' => 'list',
                    'label' => 'Lista wersji (przełącznik)',
                    'style' => 'vertical',
                    'fields' => [
                        '.title' => [
                            'type' => 'text',
                            'label' => 'Nazwa'
                        ],
                        '.url' => [
                            'type' => 'text',
                            'label' => 'Adres URL'
                        ]
                    ]
                ],
                'header_links' => [
                    'type' => 'list',
                    'label' => 'Linki w pasku górnym',
                    'style' => 'vertical',
                    'fields' => [
                        '.title' => [
                            'type' => 'text',
                            'label' => 'Nazwa'
                        ],
                        '.url' => [
                            'type' => 'text',
                            'label' => 'Adres URL'
                        ]
                    ]
                ],
                'footer_links' => [
                    'type' => 'list',
                    'label' => 'Linki w stopce',
                    'style' => 'vertical',
                    'fields' => [
                        '.title' => [
                            'type' => 'text',
                            'label' => 'Nazwa'
                        ],
                        '.url' => [
                            'type' => 'text',
                            'label' => 'Adres URL'
                        ]
                    ]
                ],
                'copyright' => [
                    'type' => 'text',
                    'label' => 'Tekst praw autorskich (domyślnie tytuł strony)'
                ],
                'github_edit_url' => [
                    'type' => 'text',
                    'label' => 'Bazowy adres edycji na GitHubie',
                    'placeholder' => 'https://github.com/user/repo/blob/main/user/pages'
                ]
            ]
        ]
    ]
];
