<?php

namespace frontend\modules\profile\widgets\TreeWidget;

use Yii;
use yii\base\Widget;

/**
 * @property int $limit
 * @property boolean $rand
 */
class TreeWidget extends Widget
{
    private $data = null;

    public function init()
    {
        // здесь получить все дерево
        $this->data = Yii::$app->app->getData();

        return parent::init();
    }

    /**
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function run()
    {
        return $this->render('default', [
            'data' => $this->data,
        ]);
    }

    /**
     * @param $categories
     * @param null $f
     * @return bool|string
     */
    public function categoriesWidgetData($categories, $level = 1)
    {
        $data = false;
        if(isset($categories['categories'])) {
            $data = $this->render('_categories', [
                'categories' => $categories['categories'],
                'level' => $level,
            ]);
        }
        /*elseif(isset($categories['products'])) {
            $data = $this->render('_products', [
                'products' => $categories['products'],
            ]);
        }*/
        return $data;
    }

    public function productWidgetData($products)
    {
        if(isset($products['products'])) {
            return $this->render('_products', [
                'products' => $products['products'],
            ]);
        }
    }
}

