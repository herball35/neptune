<?php
namespace PubBundle\Component\GooglePlaceSearcher;

interface PlaceApiClient
{
    /**
     * @param SearchMethod $method
     * @param SearchParameters $parameters
     * @return PlaceApiResponse
     */
    public function makeRequest(SearchMethod $method, SearchParameters $parameters);
}
