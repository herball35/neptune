<?php
namespace PubBundle\TypeValidationTrait;

trait NonEmptyStringVerifyingTrait
{
    /**
     * @param mixed $value
     * @param string $name
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function verifyNonEmptyString($value, $name = 'Value')
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException("$name has to be string");
        }

        $value = trim($value);
        if (strlen($value) == 0) {
            throw new \InvalidArgumentException("$name cannot be empty");
        }

        return $value;
    }
}
