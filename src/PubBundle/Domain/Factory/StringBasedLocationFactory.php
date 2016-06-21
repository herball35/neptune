<?php
namespace PubBundle\Domain\Factory;

use PubBundle\Domain\ValueObject\Location;

interface StringBasedLocationFactory
{
    /**
     * @param string $string
     * @return Location
     */
    public function createFromString($string);
}
