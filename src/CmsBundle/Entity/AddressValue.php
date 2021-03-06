<?php

namespace Opifer\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Opifer\EavBundle\Entity\Value;
use Opifer\EavBundle\Model\ValueInterface;

/**
 * Address Value.
 */
class AddressValue extends Value implements ValueInterface
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * Get the value.
     *
     * overrides the parent getValue method
     *
     * @return Address
     */
    public function getValue()
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param Address $address
     *
     * @return Value
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return (is_null($this->value) && is_null($this->address)) ? true : false;
    }
}
