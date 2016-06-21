<?php
namespace PubBundle\Domain\Entity;

use PubBundle\Domain\ValueObject\Location;
use PubBundle\Domain\ValueObject\PlaceId;
use PubBundle\Domain\ValueObject\Rating;
use PubBundle\TypeValidationTrait\NonEmptyStringVerifyingTrait;

class Place
{
    use NonEmptyStringVerifyingTrait;

    /**
     * @var PlaceId
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $address;
    /**
     * @var Location
     */
    private $location;
    /**
     * @var Rating|null
     */
    private $rating;

    /**
     * @param PlaceId $id
     * @param string $name
     * @param string $address
     * @param Location $location
     * @param Rating $rating
     */
    public function __construct(
        PlaceId $id,
        $name,
        $address,
        Location $location,
        $rating = null
    ) {
        $this->id = $id;
        $this->name = $this->verifyNonEmptyString($name, 'Place name');
        $this->address = $this->verifyNonEmptyString($address, 'Place address');
        $this->location = $location;
        if ($rating !== null && !$rating instanceof Rating) {
            throw new \InvalidArgumentException('Rating has to be null or Rating class type.');
        }
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return PlaceId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Rating|null
     */
    public function getRating()
    {
        return $this->rating;
    }
}
