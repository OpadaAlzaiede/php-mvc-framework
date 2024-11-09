<?php

namespace app\models;

use app\core\BaseModel;
use app\core\enums\ValidationRule;

class User extends BaseModel{

    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    public function register() {

        echo "registering new user";
    }

    public function rules(): array {

        return [
            'firstname' => [ValidationRule::RULE_REQUIRED->value],
            'lastname' => [ValidationRule::RULE_REQUIRED->value],
            'email' => [ValidationRule::RULE_REQUIRED->value, ValidationRule::RULE_EMAIL->value],
            'password' => [ValidationRule::RULE_REQUIRED->value, [ValidationRule::RULE_MIN->value, ['min' => 5]]],
            'passwordConfirm' => [ValidationRule::RULE_REQUIRED->value, [ValidationRule::RULE_MATCH->value, ['match' => 'password']]],
        ];
    }
}