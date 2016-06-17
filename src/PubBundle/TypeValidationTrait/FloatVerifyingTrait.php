<?php
namespace PubBundle\TypeValidationTrait;

trait FloatVerifyingTrait
{
    /**
     * @param mixed $value
     * @param string $name
     * @return float
     * @throws \InvalidArgumentException
     */
    protected function verifyFloat($value, $name = 'Value')
    {
        $value = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($value === false) {
            $message = sprintf("%s has to be an float.", $name);
            throw new \InvalidArgumentException($message);
        } else {
            return $value;
        }
    }
}
