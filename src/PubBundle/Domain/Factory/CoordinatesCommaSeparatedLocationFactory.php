<?php
namespace PubBundle\Domain\Factory;

use PubBundle\Domain\ValueObject\Latitude;
use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\Longitude;
use PubBundle\TypeValidationTrait\NonEmptyStringVerifyingTrait;

class CoordinatesCommaSeparatedLocationFactory implements StringBasedLocationFactory
{
    use NonEmptyStringVerifyingTrait;

    const SEPARATOR = ',';

    /**
     * {@inheritdoc}
     */
    public function createFromString($string)
    {
        $coordinates = $this->verifyNonEmptyString($string);
        $coordinates = explode(self::SEPARATOR, $coordinates);
        if (count($coordinates) != 2) {
            throw new \InvalidArgumentException(sprintf(
                '%d coordinates found. Coordinates have to be separated by "%s", ' .
                'and there has to be exactly two coordinates: latitude%slongitude',
                count($coordinates),
                self::SEPARATOR,
                self::SEPARATOR
            ));
        }

        return new Location(
            new Latitude($coordinates[0]),
            new Longitude($coordinates[1])
        );
    }
}
