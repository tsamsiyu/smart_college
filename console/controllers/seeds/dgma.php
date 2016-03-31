<?php

return [
    'table' => 'college',
    'rows' => [
        [
            'name' => 'Донбасская машиностроительная академия',
            'code' => 'ДГМА',
            'year_parts' => 3,
            'courses_count' => 5,
            'relations' => [
                [
                    'table' => 'college_direction',
                    'rows' => [
                        [
                            'name' => 'Автоматизация машиностроения и информационные технологии',
                            'code' => 'ФАМИТ'
                        ],
                        [
                            'name' => 'Интегрированные технологии и инструкменты',
                            'code' => 'ФИТО'
                        ],
                        [
                            'name' => 'Машиностроение',
                            'code' => 'ФМ'
                        ],
                        [
                            'name' => 'Экономики и менеджмента',
                            'code' => 'ФЕМ'
                        ]
                    ],
                    'relations' => [
                        'table' => 'college_pulpit',
                        'rows' => [
                            [
                                'name' => 'Информационные технологии',
                                'code' => 'ИТ',
                                'status' => 10
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];