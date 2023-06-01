<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property float $price
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CartItems[] $cartItems
 * @property User $createdBy
 * @property User $updatedBy
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'quantity', 'description', 'gst'], 'required'],
            ['name', 'match', 'pattern' => "/^[a-zA-Z0-9\/\\_\\-\\s]+$/", 'message' => 'Your name can only contain alphanumeric characters, underscores and dashes.'],
            [['description','gst_no', 'hsn_sac'], 'string'],
            [['quantity'], 'integer'],
            [['price', 'gst'], 'number'],
            ['gst', 'compare', 'compareValue' => 100, 'operator' => '<'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            //[['image'], 'file', 'skipOnEmpty' => false],
            [['image'], 'file', 'minFiles' => 1,  'maxFiles' => 4, 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true, 'maxSize' => 2 * 1024 * 1024],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->status = '1';
        } 
        if (!empty($this->image)){
            $this->image = json_encode($this->image, true);
        }
        return true;
    }
    public function afterFind(){

        parent::afterFind();
    
        if (!empty($this->image)){
            $this->image = json_decode($this->image, true);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'price' => 'Price',
            'status' => 'Status',
            'gst' => 'GST %',
            'hsn_sac' => 'HSN/SAC',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItems::class, ['product_id' => 'id']);
    }

    public function getReview()
    {
        return $this->hasMany(ProductReview::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getImageslist(){
        return $this->hasMany(ProductImages::class, ['product_id' => 'id']);
    }

    public function delete()
    {
        $this->status = 0;
        $this->save(false);
    }

    

    public static function sendlowqtyalert($model){
        if ($model->quantity > 100) {
            return false;
        }
        $setting = Settings::findOne(1);
        $to = $setting->company_email ?? Yii::$app->params['adminEmail']; 
        $subject = $model->name." is low stock"; 
        $message = ' 
        <html> 
        <head> 
            <title>Low Stock</title> 
        </head> 
        <body> 
                <h1>'.$model->name.' product is low '.$model->quantity.' quantity</h1> 
                </body> 
                </html>';
        $email = \Yii::$app->mailer->compose();
        $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
        $email->setTo($to);
        $email->setCharset('UTF-8');
        $email->setSubject($subject);
        $email->setHtmlBody($message);
        $email->send();
        return $email;

    }
}
