<?php

/**
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country {

    /** @ORM\Id
     *  @ORM\Column(type="integer")
     *  @ORM\GeneratedValue (strategy="AUTO")
     * */
    protected $id;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     * */
    protected $label;

    /**
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="country")
     */
    protected $customers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Country
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add customer
     *
     * @param \Application\Entity\Customer $customer
     *
     * @return Country
     */
    public function addCustomer(\Application\Entity\Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \Application\Entity\Customer $customer
     */
    public function removeCustomer(\Application\Entity\Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}
