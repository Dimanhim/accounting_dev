<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class SessionOrder extends Order
{
    /**
     * возвращает заявку по значению order_id из сессии
     * либо устанавливает в сессию последнюю
     */
    public static function getOrder()
    {
        $session = Yii::$app->session;
        $clientOrder = Order::findOne(['client_id' => Yii::$app->user->identity->id, 'id' => $session->get('order_id')]);
        if($clientOrder and $session->get('order_id') and ($order = Order::findOne($session->get('order_id')))) {
            Yii::$app->params['order_id'] = $order->id;
            Yii::$app->params['orderModel'] = $order;
        }
        elseif($lastOrder = self::lastOrder()) {
            self::setSessionOrder($lastOrder->id);
            Yii::$app->params['order_id'] = $lastOrder->id;
            Yii::$app->params['orderModel'] = $lastOrder;
        }
        else {
            Yii::$app->params['order_id'] = null;
            Yii::$app->params['orderModel'] = null;
        }
        return Yii::$app->params['orderModel'];
    }

    /**
     * устанавливает заявку в сессию
     */
    public static function setSessionOrder($order_id)
    {
        $session = Yii::$app->session;
        $session->set('order_id', $order_id);
        Yii::$app->params['order_id'] = $order_id;
    }

    /**
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function lastOrder()
    {
        return self::find()->where(['client_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->one();
    }

    /**
     * возвращает массив всех заявок клиента
     */
    public static function userOrders()
    {
        if($orders = self::find()->where(['client_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->all()) {
            $data = [];
            foreach($orders as $order) {
                $data[$order->id] = $order->orderName;
            }
            return $data;
        }
        return [];
    }

}

?>
