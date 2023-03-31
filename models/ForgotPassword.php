<?php 
namespace app\models;

use yii\base\Model;
use Yii;

class ForgotPassword extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => '\app\models\Users', 'filter' => ['status' => Users::STATUS_ACTIVE], 'message' => 'There is no user with this email address.'],
        ];
    }

    public function sendEmail()
    {
        $user = Users::findOne([
            'status' => Users::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
        if (!$user) {
            return false;
        }
        //$user->generatePasswordResetToken();
        $password = Yii::$app->getSecurity()->generateRandomString(8);
        $user->password = $password;
        if (!$user->save()) {
            return false;
        }
        $message = "<html>
            <head>
                <title>Credentials detail</title>
            </head>
            <body>
                Hi <b>" . $user->firstname . ",</b><br><br>
                Your password has been reset to access Deepwoods. Below are your credentials to access the Deepwoods system.
                <br> username : " . $this->email . "<br>password : " . $password .
                " <br> <br>
                To login to the system click <a href='" . Yii::$app->urlManager->createAbsoluteUrl('') . "'>here</a> <br><br>
                If you have any questions, please contact your Deepwoods admin.
                <br> <br>
                This is a system generated email. Please do not reply to this email.
            </body>
        </html>";
        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setHtmlBody($message)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}
?>
