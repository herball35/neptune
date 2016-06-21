<?php
namespace PubBundle\Component\GooglePlaceSearcher;

interface PlaceApiResponse
{
    /**
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return boolean
     */
    public function isSuccess();

    /**
     * @return \stdClass[]|array
     */
    public function getResults();
}
