<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'confirmPassword'], 'required'],
            ['currentPassword', 'validateCurrentPassword'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmPassword' => 'Confirm Password',
        ];
    }

    public function validateCurrentPassword($attribute, $params)
    {
        $user = Yii::$app->user->identity;

        if (!$user || !$user->validatePassword($this->$attribute)) {
            $this->addError($attribute, 'Current password is incorrect.');
        }
    }
}
