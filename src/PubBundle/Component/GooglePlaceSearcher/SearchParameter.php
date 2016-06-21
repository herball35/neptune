<?php
namespace PubBundle\Component\GooglePlaceSearcher;

interface SearchParameter
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function valueToString();
}
