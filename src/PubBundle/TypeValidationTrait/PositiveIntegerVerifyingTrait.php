<?php
namespace PubBundle\TypeValidationTrait;

trait PositiveIntegerVerifyingTrait
{
    /**
     * @param mixed $value
     * @param string $name
     * @return int
     * @throws \InvalidArgumentException
     */
    protected function verifyPositiveInteger($value, $name = 'Value')
    {
        $value = filter_var($value, FILTER_VALIDATE_INT);

        if ($value === false) {
            $message = sprintf("%s has to be an integer", $name);
            throw new \InvalidArgumentException($message);
        }

        $value = (int)$value;

        if ($value <= 0) {
            $message = sprintf("%s has to be a positive number", $name);
            throw new \InvalidArgumentException($message);
        }

        return $value;
    }
}
