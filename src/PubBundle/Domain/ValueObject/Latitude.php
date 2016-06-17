<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\TypeValidationTrait\FloatVerifyingTrait;

class Latitude
{
    use FloatVerifyingTrait;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @param float $latitude
     */
    public function __construct($latitude)
    {
        $latitude = $this->verifyFloat($latitude, 'Latitude');
        if ($latitude < -90 || $latitude > 90) {
            throw new \InvalidArgumentException(sprintf(
                'Latitude has to be between %d and %d.'
                -90,
                90
            ));
        }
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->latitude;
    }
}
