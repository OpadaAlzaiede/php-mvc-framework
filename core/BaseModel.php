<?php

namespace app\core;

use app\core\enums\ValidationRule;

abstract class BaseModel {

    public array $errors = [];

    public function loadData(array $data) {

        foreach($data as $key => $value) {

            if(property_exists($this, $key)) {
                
                $this->$key = $value;
            }
        }
    }

    abstract public function rules(): array;  

    public function validate() {

        foreach($this->rules() as $attribute => $rules) {

            $value = $this->{$attribute};

            foreach($rules as $rule) {

                $ruleName = $rule;

                if(is_array($rule)) {

                    $ruleName = $rule[0];
                    $params = $rule[1];
                }

                if($ruleName === ValidationRule::RULE_REQUIRED->value && !$value) {

                    $this->addError($attribute, ValidationRule::RULE_REQUIRED->value);
                }

                if($ruleName === ValidationRule::RULE_EMAIL->value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {

                    $this->addError($attribute, ValidationRule::RULE_EMAIL->value);
                }

                if($ruleName === ValidationRule::RULE_MIN->value && strlen($value) < $params['min']) {

                    $this->addError($attribute, ValidationRule::RULE_MIN->value, $params);
                }

                if($ruleName === ValidationRule::RULE_MAX->value && strlen($value) > $params['max']) {
                    $this->addError($attribute, ValidationRule::RULE_MIN->value, $params);
                }

                if($ruleName === ValidationRule::RULE_MATCH->value && $value !== $this->{$params['match']}) {
                    $this->addError($attribute, ValidationRule::RULE_MATCH->value, $params);
                }
            }
        }

        return empty($this->errors); 
    }

    public function addError(string $attribute, string $rule, array $params = []) {

        $errorMessage = ValidationRule::messages()[$rule] ?? '';

        foreach($params as $key => $value) {

            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }

        $this->errors[$attribute][] = $errorMessage;
    }
}