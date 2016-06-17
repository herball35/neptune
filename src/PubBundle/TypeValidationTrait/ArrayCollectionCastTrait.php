<?php
namespace PubBundle\TypeValidationTrait;

trait ArrayCollectionCastTrait
{
    /**
     * @param object[]|array $elements
     * @param string $className
     * @return object[]|array
     */
    protected function makeCollectionOfValid($elements, $className)
    {
        if (!class_exists($className) && !interface_exists($className)) {
            throw new \InvalidArgumentException(sprintf("Given class name %s doesn't exist", $className));
        }

        $sanitized = [];
        if (is_array($elements)) {
            foreach ($elements as $key => $element) {
                if (is_object($element) && is_a($element, $className)) {
                    $sanitized[$key] =  $element;
                } else {
                    throw new \InvalidArgumentException(
                        sprintf('Invalid collection passed - use only elements of type %s', $className)
                    );
                }
            }
            return $sanitized;
        } else {
            throw new \InvalidArgumentException(
                sprintf('Invalid collection passed - use array of %s', $className)
            );
        }
    }
}
