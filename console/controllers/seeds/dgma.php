<?php

$faker = \Faker\Factory::create();

return [
    'name' => 'Донбасская машиностроительная академия',
    'code' => 'ДГМА',
    'year_parts' => 3,
    'courses_count' => 5,
    'college_direction' => [
        [
            'name' => 'Автоматизация машиностроения и информационные технологии',
            'code' => 'ФАМИТ',
            'college_pulpit' => [
                [
                    'name' => 'Информационные технологии',
                    'code' => 'ИТ',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Методы и системы искусственного интеллекта',
                            'code' => 'МСИИ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Технология защиты информации',
                            'code' => 'ТЗИ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Анализ и обработка данных',
                            'code' => 'АОД',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Проектирование систем автоматизации',
                            'code' => 'ПСА',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Теория автоматического управления',
                            'code' => 'ТАУ',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Автоматизация производственных процессов',
                    'code' => 'АПП',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Автоматизация производственного оборудования',
                            'code' => 'АПО',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Контроллеры и их программное обеспечение',
                            'code' => 'КиПО',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Автоматизация в энергетических системах',
                            'code' => 'АвЭС',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Интеллектуальные системы принятия решений',
                    'code' => 'ИСПР',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Алгоритмы и структуры данных',
                            'code' => 'АиСД',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Нейросетевые технологии',
                            'code' => 'НТ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Информационные системы в экономике',
                            'code' => 'ИСЭ',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Электромеханические системы механизации',
                    'code' => 'ЭСМ',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Автоматизация электромеханических систем',
                            'code' => 'АЭС',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Анализ и синтез оптимальных систем управления электроприводами',
                            'code' => 'АиСЭ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Динамика и диагностика',
                            'code' => 'ДиД',
                            'description' => $faker->sentence()
                        ]
                    ]
                ]
            ]
        ],
        [
            'name' => 'Интегрированные технологии и инструкменты',
            'code' => 'ФИТО',
            'college_pulpit' => [
                [
                    'name' => 'Приборы и технологи сварки',
                    'code' => 'ПиТС',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Автоматическое управление сваркой',
                            'code' => 'АУС',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Гидропневмопривод',
                            'code' => 'Гп',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Электрические машины',
                            'code' => 'ЭМ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Металургические основы плавления',
                            'code' => 'МОП',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Технологии и приборы литейного производства',
                    'code' => 'ТОЛП',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Производство слитков из чугуна',
                            'code' => 'ПСЧ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Теплотехника и печи литейных цехов',
                            'code' => 'ТиПЛЦ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Производство слитков из стали',
                            'code' => 'ПСС',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Технологии и управление производством',
                    'code' => 'ТМ',
                    'status' => 10,
                    'subjects' => [
                        [
                            'name' => 'Эксплуатация и обслуживание машин',
                            'code' => 'ЭиОМ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Устройства и приборы механических цехов',
                            'code' => 'УиПМЦ',
                            'description' => $faker->sentence()
                        ],
                        [
                            'name' => 'Резальный инструмент',
                            'code' => 'РИ',
                            'description' => $faker->sentence()
                        ]
                    ]
                ],
                [
                    'name' => 'Обработка металла давлением',
                    'code' => 'ОМД',
                    'status' => 10
                ],
                [
                    'name' => 'Основы проектирования машин',
                    'code' => 'ОПМ',
                    'status' => 10
                ],
                [
                    'name' => 'Химия и охрана труда',
                    'code' => 'ХиОТ',
                    'status' => 10
                ]
            ]
        ],
        [
            'name' => 'Машиностроение',
            'code' => 'ФМ',
            'college_pulpit' => [
                [
                    'name' => 'Автоматизация металургийных машин и инструментов',
                    'code' => 'АММИ',
                    'status' => 10
                ],
                [
                    'name' => 'Высшая математика',
                    'code' => 'ВМ',
                    'status' => 10
                ],
                [
                    'name' => 'Инженерная и компьютерная графика',
                    'code' => 'ИГ',
                    'status' => 10
                ],
                [
                    'name' => 'Физика',
                    'code' => 'Физика',
                    'status' => 10
                ],
                [
                    'name' => 'Компьютеризованные мехатронные системы и технологии',
                    'code' => 'МБИ',
                    'status' => 10
                ]
            ]
        ],
        [
            'name' => 'Экономики и менеджмента',
            'code' => 'ФЕМ',
            'college_pulpit' => [
                [
                    'name' => 'Финансы',
                    'code' => 'Ф',
                    'status' => 10
                ],
                [
                    'name' => 'Учет и аудит',
                    'code' => 'ОиА',
                    'status' => 10
                ],
                [
                    'name' => 'Экономика и предприятие',
                    'code' => 'ЭП',
                    'status' => 10
                ],
                [
                    'name' => 'Менеджемент',
                    'code' => 'Менеджемент',
                    'status' => 10
                ],
                [
                    'name' => 'Иностранный язык',
                    'code' => 'ИМ',
                    'status' => 10
                ],
                [
                    'name' => 'Экономическая теория',
                    'code' => 'ЭМ',
                    'status' => 10
                ],
                [
                    'name' => 'Философия',
                    'code' => 'Философия',
                    'status' => 10
                ],
                [
                    'name' => 'Физическое воспитание',
                    'code' => 'ФВ',
                    'status' => 10
                ]
            ]
        ]
    ]
];