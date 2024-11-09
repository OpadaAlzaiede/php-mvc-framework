<?php

namespace app\core\enums;

enum ValidationRule: string {

    case RULE_REQUIRED = 'required';
    case RULE_EMAIL = 'email';
    case RULE_MIN = 'min';
    case RULE_MAX = 'max';
    case RULE_MATCH = 'match';

    public static function messages(): array {

        return [
            self::RULE_REQUIRED->value => 'This field is required',
            self::RULE_EMAIL->value => 'This field must be a valid email address',
            self::RULE_MIN->value => 'Min Length of this field must be {min}',
            self::RULE_MAX->value => 'Max Length of this field must be {max}',
            self::RULE_MATCH->value => 'This field must be the same as {match}'
        ];
    }
}