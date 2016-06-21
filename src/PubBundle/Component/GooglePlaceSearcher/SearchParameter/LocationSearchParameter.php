<?php
namespace PubBundle\Component\GooglePlaceSearcher\SearchParameter;

use PubBundle\Component\GooglePlaceSearcher\AbstractSearchParameter;
use PubBundle\Domain\ValueObject\Location;

class LocationSearchParameter extends AbstractSearchParameter
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'location';

    /**
     * @var Location
     */
    protected $value;

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->value = $location;
    }

    /**
     * {@inheritdoc}
     */
    public function valueToString()
    {
        return sprintf(
            '%f,%f',
            $this->value->getLatitude()->getValue(),
            $this->value->getLongitude()->getValue()
        );
    }
}
