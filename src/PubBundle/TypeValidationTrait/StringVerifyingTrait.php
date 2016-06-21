<?php
namespace PubBundle\TypeValidationTrait;

trait StringVerifyingTrait
{
    /**
     * @param mixed $value
     * @param string $name
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function verifyString($value, $name = 'Value')
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException("$name has to be string");
        }

        return $value;
    }
}
