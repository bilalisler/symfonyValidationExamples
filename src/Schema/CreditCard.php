<?php

namespace App\Schema;

use App\Validator\Constraints as AssertC;
use Symfony\Component\Validator\Constraints as Assert;

class CreditCard
{
    // @AssertC\ConstraintFullName
    /**
     * @Assert\NotBlank(message="full name cannot be empty")
     */
    private $fullName;


    // @AssertC\CheckCardType
    /**
     * @AssertC\CheckCardType
     *
     * @Assert\NotBlank(message="card number cannot be empty")
     *
     * @Assert\CardScheme(
     *     schemes={"VISA"},
     *     message="Your credit card is not VISA.",
     *     groups={"payment"}
     * )
     */
    private $cardNumber;

    /**
     * @Assert\NotBlank(message="year cannot be empty")
     */
    private $year;

    /**
     * @Assert\NotBlank(message="month cannot be empty")
     *
     * @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      notInRangeMessage = "month most be between {{ min }} and {{ max }}",
     * )
     */
    private $month;


    /**
     *  @Assert\NotBlank(message="Cvv cannot be empty",groups={"debit"})
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 3,
     *      minMessage = "Your cvv must be at least {{ limit }} characters long",
     *      maxMessage = "Your cvv cannot be longer than {{ limit }} characters"
     * )
     */
    private $cvv;

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     * @return CreditCard
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param mixed $cardNumber
     * @return CreditCard
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return CreditCard
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     * @return CreditCard
     */
    public function setMonth($month)
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param mixed $cvv
     * @return CreditCard
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }


}
