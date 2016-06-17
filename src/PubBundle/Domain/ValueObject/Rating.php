<?php
namespace PubBundle\Domain\ValueObject;

use PubBundle\TypeValidationTrait\PositiveFloatVerifyingTrait;

class Rating
{
    use PositiveFloatVerifyingTrait;

    /**
     * @var float
     */
    private $rating;

    /**
     * @param float $rating
     */
    public function __construct($rating)
    {
        $rating = $this->verifyPositiveFloat($rating, 'Rating');
        if ($rating < 1 || $rating > 5) {
            throw new \InvalidArgumentException(sprintf(
                'Rating has to be value between %d and %d.',
                1,
                5
            ));
        }
        $this->rating = $rating;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->rating;
    }
}
