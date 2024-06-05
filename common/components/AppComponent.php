<?php

namespace common\components;

class AppComponent
{

    public function getData()
    {
        return [
            [
                'id' => 1,
                'type' => 'organization',
                'name' => 'Организация 1',
                'stores' => [
                    [
                        'id' => 1,
                        'type' => 'store',
                        'name' => 'Магазин 1.1',
                        'categories' => [
                            [
                                'id' => 1,
                                'type' => 'category',
                                'name' => 'Категория 1.1.1',
                                'categories' => [
                                    [
                                        'id' => 2,
                                        'type' => 'category',
                                        'name' => 'Категория 1.1.1.1',
                                        'products' => [
                                            [
                                                'id' => 1,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.1.1.1.1'
                                            ],
                                            [
                                                'id' => 2,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.1.1.1.2'
                                            ],
                                            [
                                                'id' => 3,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.1.1.1.3'
                                            ],
                                        ],
                                    ],
                                ],
                            ],

                        ],
                    ],
                    [
                        'id' => 2,
                        'type' => 'store',
                        'name' => 'Магазин 1.2',
                        'categories' => [
                            [
                                'id' => 3,
                                'type' => 'category',
                                'name' => 'Категория 1.2.1',
                                'categories' => [
                                    [
                                        'id' => 4,
                                        'type' => 'category',
                                        'name' => 'Категория 1.2.1.1',
                                        'products' => [
                                            [
                                                'id' => 4,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.2.1.1.1'
                                            ],
                                            [
                                                'id' => 5,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.2.1.1.2'
                                            ],
                                            [
                                                'id' => 6,
                                                'type' => 'product',
                                                'name' => 'Продукт 1.2.1.1.3'
                                            ],
                                        ],
                                    ],
                                ],
                            ],

                        ],
                    ],
                ],
            ],
            [
                'id' => 2,
                'type' => 'organization',
                'name' => 'Организация 2',
                'stores' => [
                    [
                        'id' => 3,
                        'type' => 'store',
                        'name' => 'Магазин 2.1',
                        'categories' => [
                            [
                                'id' => 5,
                                'type' => 'category',
                                'name' => 'Категория 2.1.1',
                                'products' => [
                                    [
                                        'id' => 7,
                                        'type' => 'product',
                                        'name' => 'Продукт 2.1.1.1'
                                    ],
                                    [
                                        'id' => 8,
                                        'type' => 'product',
                                        'name' => 'Продукт 2.1.1.2'
                                    ],
                                    [
                                        'id' => 9,
                                        'type' => 'product',
                                        'name' => 'Продукт 2.1.1.3'
                                    ],
                                ],
                            ],
                            [
                                'id' => 6,
                                'type' => 'category',
                                'name' => 'Категория 2.2.1',
                                'categories' => [
                                    [
                                        'id' => 7,
                                        'type' => 'category',
                                        'name' => 'Категория 2.2.1.1',
                                        'products' => [
                                            [
                                                'id' => 10,
                                                'type' => 'product',
                                                'name' => 'Продукт 2.2.1.1.1'
                                            ],
                                            [
                                                'id' => 11,
                                                'type' => 'product',
                                                'name' => 'Продукт 2.2.1.1.2'
                                            ],
                                            [
                                                'id' => 12,
                                                'type' => 'product',
                                                'name' => 'Продукт 2.2.1.1.3'
                                            ],
                                        ],
                                    ],
                                ],
                            ],

                        ],
                    ],
                ],
            ],
        ];
    }

    /*public function categoriesWidgetData($categories)
    {
        $data = false;
        if(isset($categories['categories'])) {
            $data = \Yii::$app->controller->renderPartial('//modules/widgets/TreeWidget/views/default/tree/_categories', [
                'categories' => $categories,
            ]);
        }
        elseif(isset($categories['products'])) {
            $data = \Yii::$app->controller->renderPartial('/default/tree/_products', [
                'products' => $categories['products'],
            ]);
        }
        return $data;
    }

    public function productWidgetData($products)
    {
        return \Yii::$app->controller->renderPartial('/default/tree/_products', [
            'products' => $products,
        ]);
    }*/
}
