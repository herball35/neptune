<?php
namespace PubBundle\Component\GooglePlaceSearcher\SearchParameter;

use PubBundle\Component\GooglePlaceSearcher\AbstractSearchParameter;
use PubBundle\TypeValidationTrait\PositiveIntegerVerifyingTrait;

class RadiusSearchParameter extends AbstractSearchParameter
{
    use PositiveIntegerVerifyingTrait;

    /**
     * {@inheritdoc}
     */
    protected $name = 'radius';

    /**
     * @param int $radius
     */
    public function __construct($radius)
    {
        $this->value = $this->verifyPositiveInteger($radius, 'Radius');
    }
}
