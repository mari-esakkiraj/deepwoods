<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property float $total_price
 * @property int $status
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string|null $transaction_id
 * @property string|null $paypal_order_id
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property Users $createdBy
 * @property OrderAddresses $orderAddresses
 * @property OrderItems[] $orderItems
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_price', 'status', 'firstname',], 'required'],
            [['total_price'], 'number'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['email', 'transaction_id', 'paypal_order_id', 'shipping_address_id'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'transaction_id' => 'Transaction ID',
            'paypal_order_id' => 'Paypal Order ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'paypal_order_id' => 'Paypal Order ID',
            'billing_address_id' => 'Billing Address',
            'shipping_address_id' => 'Shipping Address',
            'phone' => 'Phone',
            'customer_id' => 'Customer'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[OrderAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAddresses()
    {
        return $this->hasOne(OrderAddresses::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }

    public function saveOrderItems()
    {
        $cartItems = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItems();
            $orderItem->product_name = $cartItem->product->name;
            $orderItem->product_id = $cartItem->product->id;
            $orderItem->unit_price = $cartItem->product->price;
            $orderItem->order_id = $this->id;
            $orderItem->quantity = $cartItem->quantity;
            if (!$orderItem->save()) {
                throw new Exception("Order item was not saved: " . implode('<br>', $orderItem->getFirstErrors()));
            }
        }

        return true;
    }
}
