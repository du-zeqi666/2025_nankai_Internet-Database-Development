<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

/**
 * User management commands.
 */
class UserController extends Controller
{
    /**
     * Create a new user.
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function actionCreate($username, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE; // 直接设置为激活状态

        if ($user->save()) {
            $this->stdout("User [$username] created successfully.\n");
            return Controller::EXIT_CODE_NORMAL;
        } else {
            $this->stderr("Error creating user:\n");
            foreach ($user->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->stderr(" - $error\n");
                }
            }
            return Controller::EXIT_CODE_ERROR;
        }
    }
}
