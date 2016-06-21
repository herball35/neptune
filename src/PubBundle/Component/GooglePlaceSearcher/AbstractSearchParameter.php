<?php
namespace PubBundle\Component\GooglePlaceSearcher;

abstract class AbstractSearchParameter implements SearchParameter
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var mixed
     */
    protected $value;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function valueToString()
    {
        return (string) $this->value;
    }
}
