<?php


namespace Models;


abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_NUMBER = 'number';
    public const RULE_DATE = 'date';

    //these eventually if needed
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';

    public array $errors = array();


    public function loadData(array $userData)
    {

        foreach ($userData as $_k => $_v) {

            if (property_exists($this, $_k)) {

                $this->{$_k} = $_v;

            }

        }

    }

    abstract public function rules(): array;


    public function validate()
    {

        foreach ($this->rules() as $attr => $rule_set) {
            $value = $this->{$attr};
            foreach ($rule_set as $rule) {

                $ruleName = $rule;

                if (!is_string($ruleName)) {

                    $ruleName = $rule[0];

                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {

                    $this->addError($attr, self::RULE_REQUIRED);

                }

            }

        }


        return (empty($this->errors));

    }

    public function addError(string $attr, string $rule, array $params = array())
    {
        $message = self::errorMessages()[$rule] ?? '';

        foreach ($params as $_k => $_v)
        {

            $message = str_replace("{$_k}", $_v, $message);

        }

        $this->errors[$attr][] = $message;

    }

    public function errorMessages()
    {

        return array(
            self::RULE_REQUIRED => 'This is required!',
            self::RULE_DATE => 'This must be a valid date!',
            self::RULE_EMAIL => 'This must be a valid email address!',
            self::RULE_MATCH => 'This field must match as {match}!',
            self::RULE_MAX => 'This must be a maximum of {max} characters!',
            self::RULE_MIN => 'This must be a minimum of {min} characters!'

        );

    }

    public function hasError($attr)
    {

        return $this->errors[$attr] ?? false;

    }

    public function getFirstError($attr)
    {

        return $this->errors[$attr][0] ?? false;

    }

}