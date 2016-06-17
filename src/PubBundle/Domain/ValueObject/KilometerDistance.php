<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\TypeValidationTrait\PositiveFloatVerifyingTrait;

class KilometerDistance
{
    use PositiveFloatVerifyingTrait;

    /**
     * @var float
     */
    private $distance;

    /**
     * @param float $distance
     */
    public function __construct($distance)
    {
        $this->distance = $this->verifyPositiveFloat($distance, 'Distance');
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->distance;
    }
}
