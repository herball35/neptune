<?php
namespace PubBundle\Component\GooglePlaceSearcher;

interface SearchParameters
{
    /**
     * @return SearchParameter[]|array
     */
    public function getAllParameters();
}
