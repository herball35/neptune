<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\TypeValidationTrait\FloatVerifyingTrait;

class Longitude
{
    use FloatVerifyingTrait;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @param float $longitude
     */
    public function __construct($longitude)
    {
        $longitude = $this->verifyFloat($longitude, 'Longitude');
        if ($longitude < -180 || $longitude > 180) {
            throw new \InvalidArgumentException(sprintf(
                'Longitude has to be between %d and %d.'
                -180,
                180
            ));
        }
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->longitude;
    }
}
