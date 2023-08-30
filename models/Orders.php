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
            [['status', 'created_at', 'created_by','cashondelivery'], 'integer'],
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
            'created_at' => 'Date',
            'created_by' => 'Created By',
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
            $orderItem->product_gst_price = 0;
            if($cartItem->product->gst !=0 && $cartItem->product->gst != null){
                $orderItem->product_gst_price = ($cartItem->product->price * $cartItem->quantity) * ($cartItem->product->gst / 100);
            }

            if (!$orderItem->save()) {
                throw new Exception("Order item was not saved: " . implode('<br>', $orderItem->getFirstErrors()));
            }
        }

        return true;
    }

    public static function sentOrderConfirm($order) {
        $msg = "<p>Hi {$order->firstname}  {$order->lastname}</p>
        <p>Your payment was successful and Your Payment ID: <b> {$order->paypal_order_id}</b></p>";
        $message = "<html>
            <head>
                <title>Order Confirmation</title>
            </head>
            <body>
                {$msg}
                This is a system generated email. Please do not reply to this email.
            </body>
        </html>";
        
        $subject = 'Order Confirmation #' . $order->order_code;
        $email = \Yii::$app->mailer->compose();
        $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
        $email->setTo($order->email);
        $email->setCharset('UTF-8');
        $email->setSubject($subject);
        $email->setHtmlBody($message);
        $email->send();
        return $email;
    }
    public static function sentOrder($order) {
        $items = OrderItems::find()->where(['order_id' => $order->id])->all();

        $msg = "<p>Dear  {$order->firstname}  {$order->lastname},</p>
        We have received your recent order, {$order->order_code} in Our Deepwoods Organics webstore. Thank you for choosing us for your shopping needs.Here are all the details: </p> ";
        $ordersummary="<h5>Your Order Summary:</h5>
            <table style='--bs-table-color: var(--bs-body-color);--bs-table-bg: transparent;--bs-table-border-color: var(--bs-border-color);--bs-table-accent-bg: transparent;--bs-table-striped-color: var(--bs-body-color);--bs-table-striped-bg: rgba(0, 0, 0, 0.05);--bs-table-active-color: var(--bs-body-color);--bs-table-active-bg: rgba(0, 0, 0, 0.1);--bs-table-hover-color: var(--bs-body-color);--bs-table-hover-bg: rgba(0, 0, 0, 0.075);width: 100%;margin-bottom: 1rem;color: var(--bs-table-color);vertical-align: top;border-color: var(--bs-table-border-color);'>
                <thead>
                <tr>
                    <th style='background-color: #00000000;border-bottom-width: 0;text-align: -webkit-match-parent;padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;'>Name</th>
                    <th style='background-color: #00000000;border-bottom-width: 0;text-align: -webkit-match-parent;padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;'>Qty</th>
                    <th style='background-color: #00000000;border-bottom-width: 0;text-align: -webkit-match-parent;padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;'>Price</th>
                    <th style='background-color: #00000000;border-bottom-width: 0;text-align: -webkit-match-parent;padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;'>GST</th>
                </tr>
                </thead>
                <tbody>";
                    foreach($items as $item){
                        $ordersummary .= "
                        <tr> 
                            <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'>{$item->product_name}</td> 
                            <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none; text-align: right;'>{$item->quantity}</td> 
                            <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none; text-align: right;'>{$item->unit_price}</td> 
                            <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none; text-align: right;'>{$item->product_gst_price}</td>
                        </tr>";
                    }
                
                    $promotionmsg = "";
                    if($order->promotion_price>0) {
                        $promotionmsg = "<tr>
                        <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'><b>Discount</b></td>
                        <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none;text-align: right;'>".$order->promotion_price."</td>
                    </tr>";
                    }
                 $ordersummary .= "        
                </tbody>
            </table>
            <table style='--bs-table-color: var(--bs-body-color);--bs-table-bg: transparent;--bs-table-border-color: var(--bs-border-color);--bs-table-accent-bg: transparent;--bs-table-striped-color: var(--bs-body-color);--bs-table-striped-bg: rgba(0, 0, 0, 0.05);--bs-table-active-color: var(--bs-body-color);--bs-table-active-bg: rgba(0, 0, 0, 0.1);--bs-table-hover-color: var(--bs-body-color);--bs-table-hover-bg: rgba(0, 0, 0, 0.075);width: 100%;margin-bottom: 1rem;color: var(--bs-table-color);vertical-align: top;border-color: var(--bs-table-border-color);'>
                <tr>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;'><b>Total Items</b></td>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;text-align: right;'>".count($items)."</td>
                </tr>
                <tr>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'><b>Total Price</b></td>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none;text-align: right;'>".$order->products_gst_price."</td>
                </tr>
                <tr>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'><b>GST</b></td>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none;text-align: right;'>".$order->gst."</td>
                </tr>
                <tr>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'><b>Freight Charges</b></td>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none;text-align: right;'>".$order->freight_charges."</td>
                </tr>
                {$promotionmsg}
                <tr>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-right: none;border-top: none;'><b>Total</b></td>
                    <td style='padding: 0.25rem 0.25rem;border: 1px solid #ececec;vertical-align: middle;border-top: none;text-align: right;'>".$order->total_price."</td>
                </tr>
            </table>";
            $msg=$msg.$ordersummary;
            $msgold = "<table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
                <tr> 
                    <th style='text-align:left'>Product Name:</th><th>Quantity</th> <th>Unit Price</th> 
                </tr> ";
                if(!empty($items)) {
                    foreach($items as $item){
                        $msgold .= '     
                        <tr > 
                            <td>'.$item->product_name.'</td><td style="text-align:center">'.$item->quantity.'</td> <td style="text-align:center">'.$item->unit_price.'</td> 
                        </tr> ';
                    }
                }

                $msgold .= '     
                <tr > 
                    <th colspan="2" style="text-align:right">SubTotal:</th><td>'.number_format(($order->total_price-($order->gst+$order->freight_charges)),2).'</td> 
                </tr> 
                <tr > 
                    <th colspan="2" style="text-align:right">GST:</th><td>'.$order->products_gst_price.'</td> 
                </tr> 
                <tr > 
                    <th colspan="2" style="text-align:right">GST:</th><td>'.$order->gst.'</td> 
                </tr> 
                </tr> <tr > 
                    <th colspan="2" style="text-align:right">Freight Charges:</th><td>'.$order->freight_charges.'</td> 
                </tr> 
                <tr > 
                    <th colspan="2" style="text-align:right">Total:</th><td>'.$order->total_price.'</td> 
                </tr> 
                    </table>'; 
                $msg .= '<p>We are currently processing your order and will keep you updated on the status of your shipment. You can expect to receive your products in minimum 2 business working days, Maximum 4 business working days, If you still didnt receive your products after 4 business working days, please call back us with your Order number @+91 6380589226.</p><br>
                        <p>If you have any questions or concerns about your order, please don’t hesitate to contact us. Our customer service team is always happy to assist you.</p><br>
                        <p>Thank you for your support. We look forward to serving you again in the future.</p><br>
                        <p>Best regards,<br>
                        Deepwoods Organics<br>
                        Processing Team<br></p>';
        $message = "<html>
            <head>
                <title>Order Confirmation</title>
            </head>
            <body>
                {$msg}
                <br>
                <small>This is a system generated email. Please do not reply to this email.</small>
            </body>
        </html>"; 
        
        $subject = "Your Order:".$order->order_code." Has Been Received"; 
        $email = \Yii::$app->mailer->compose();
        $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
        $email->setTo($order->email);
        $email->setCharset('UTF-8');
        $email->setSubject($subject);
        $email->setHtmlBody($message);
        $email->send();
        
        if ($order->qrcode == 1) {
            $setting = Settings::findOne(1);

            $to = $setting->company_email ?? Yii::$app->params['adminEmail'];
            //$to = Yii::$app->params['adminEmail']; 
            $subject = "QR Code Order : ".$order->transaction_id; 
            $message = ' 
            <html> 
            <head> 
                <title>QR Code Order</title> 
            </head> 
            <body> 
                    <h1>Invoice Number : '.$order->invoice_code.'</h1> 
                    <h1>Transaction number : '.$order->transaction_id.'</h1> 
                    <h1>Customer Name : '."{$order->firstname}  {$order->lastname}".'</h1> 
                    <h1>Customer Mobile Number : '.$order->phone.'</h1> 
                    '.$ordersummary.'
                    </body> 
                    </html>';
            $email = \Yii::$app->mailer->compose();
            $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
            $email->setTo($to);
            $email->setCharset('UTF-8');
            $email->setSubject($subject);
            $email->setHtmlBody($message);
            $email->send();
        }
        return $email;
    }
}
