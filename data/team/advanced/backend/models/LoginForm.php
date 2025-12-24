<?php
namespace backend\models;

use common\models\LoginForm as CommonLoginForm;

/**
 * Login form for backend
 */
class LoginForm extends CommonLoginForm
{
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            } elseif ($user->profile !== '系统管理员') {
                $this->addError($attribute, 'You are not authorized to login to backend.');
            }
        }
    }
}
