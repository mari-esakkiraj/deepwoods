<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $message
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email','message'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {

        //if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin'])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject("Deepwoodsorganics Contact Us Form")
                ->setTextBody($this->message)
                ->send();

            return true;
        //}
        //return false;
    }
}
