<?php
namespace PubBundle\Component\GooglePlaceSearcher\SearchParameter;

use PubBundle\Component\GooglePlaceSearcher\AbstractSearchParameter;
use PubBundle\TypeValidationTrait\NonEmptyStringVerifyingTrait;

class LocationTypeSearchParameter extends AbstractSearchParameter
{
    use NonEmptyStringVerifyingTrait;

    /**
     * @var array|string[]
     */
    private $supportedTypes = [
        'accounting' => 'accounting',
        'airport' => 'airport',
        'amusement_park' => 'amusement_park',
        'aquarium' => 'aquarium',
        'art_gallery' => 'art_gallery',
        'atm' => 'atm',
        'bakery' => 'bakery',
        'bank' => 'bank',
        'bar' => 'bar',
        'beauty_salon' => 'beauty_salon',
        'bicycle_store' => 'bicycle_store',
        'book_store' => 'book_store'
        //TODO nad many more types https://developers.google.com/places/supported_types#table1
    ];

    /**
     * {@inheritdoc}
     */
    protected $name = 'type';

    /**
     * @param string $tye
     */
    public function __construct($type)
    {
        $type = $this->verifyNonEmptyString($type, 'Type');
        if (!array_key_exists($type, $this->supportedTypes)) {
            throw new \InvalidArgumentException(sprintf(
                'Not supported location type "%s".',
                $type
            ));
        }
        $this->value = $type;
    }
}
