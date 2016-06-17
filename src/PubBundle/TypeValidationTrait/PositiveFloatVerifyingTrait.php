<?php
namespace PubBundle\TypeValidationTrait;

trait PositiveFloatVerifyingTrait
{
    protected function verifyPositiveFloat($value, $name = 'Value')
    {
        $value = $value = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($value === false) {
            $message = sprintf("%s has to be an float", $name);
            throw new \InvalidArgumentException($message);
        }

        $value = (float)$value;

        if ($value <= 0) {
            $message = sprintf("%s has to be a positive float", $name);
            throw new \InvalidArgumentException($message);
        }

        return $value;
    }
}
