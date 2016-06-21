<?php
namespace PubBundle\Component\GooglePlaceSearcher;

class NearbyPlacesSearcher implements SearchMethod
{
    private $name = 'nearbysearch';

    /**
     * @var PlaceApiClient
     */
    private $apiClient;

    /**
     * @param PlaceApiClient $apiClient
     */
    public function __construct(PlaceApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param NearbySearchParameters $parameters
     * @return PlaceApiResponse
     */
    public function search(NearbySearchParameters $parameters)
    {
        return $this->apiClient->makeRequest($this, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
