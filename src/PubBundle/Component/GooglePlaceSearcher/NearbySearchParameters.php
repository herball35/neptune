<?php
namespace PubBundle\Component\GooglePlaceSearcher;

use PubBundle\Component\GooglePlaceSearcher\SearchParameter\LocationSearchParameter;
use PubBundle\Component\GooglePlaceSearcher\SearchParameter\RadiusSearchParameter;
use PubBundle\TypeValidationTrait\ArrayCollectionCastTrait;

class NearbySearchParameters implements SearchParameters
{
    use ArrayCollectionCastTrait;

    /**
     * @var LocationSearchParameter
     */
    private $locationParameter;

    /**
     * @var RadiusSearchParameter
     */
    private $radiusParameter;

    /**
     * @var array|SearchParameter[]
     */
    private $additionalParameters;

    /**
     * @param LocationSearchParameter $locationParameter
     * @param RadiusSearchParameter $radiusParameter
     * @param array|SearchParameter[] $additionalParameters
     */
    public function __construct(
        LocationSearchParameter $locationParameter,
        RadiusSearchParameter $radiusParameter,
        $additionalParameters = []
    ) {

        $this->locationParameter = $locationParameter;
        $this->radiusParameter = $radiusParameter;
        $this->additionalParameters = $this->makeCollectionOfValid(
            $additionalParameters,
            SearchParameter::class
        );

        $allParameters = $additionalParameters;
        $allParameters[] = $locationParameter;
        $allParameters[] = $radiusParameter;
        $this->verifyParameterUniqueness($allParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllParameters()
    {
        $allParameters = $this->additionalParameters;
        $allParameters[] = $this->locationParameter;
        $allParameters[] = $this->radiusParameter;

        return $allParameters;
    }


    /**
     * @param array|SearchParameter[] $parameters
     */
    private function verifyParameterUniqueness($parameters)
    {
        $parameterNames = [];
        foreach ($parameters as $parameter) {
            $parameterName = $parameter->getName();
            if (array_key_exists($parameterName, $parameterNames)) {
                throw new \InvalidArgumentException(sprintf(
                    'Parameter name "%s" is not unique.',
                    $parameterName
                ));
            } else {
                $parameterNames[$parameterName] = 1;
            }
        }
    }
}
