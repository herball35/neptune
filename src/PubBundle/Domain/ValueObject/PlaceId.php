<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\TypeValidationTrait\NonEmptyStringVerifyingTrait;

class PlaceId
{
    use NonEmptyStringVerifyingTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $this->verifyNonEmptyString($id, 'Place ID');
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->id;
    }
}
