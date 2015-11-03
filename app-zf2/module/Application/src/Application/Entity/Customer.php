<?php

/**
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\CustomerRepository")
 */
Class Customer {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     */
    protected $label;

    /**
     * @ORM\Column(type="string",length=100,nullable=false)
     */
    protected $address;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="Country",inversedBy="customers")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id",nullable=true)
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="sale", mappedBy="customer")
     */
    protected $sales;

    /**
     * Constructor
     */
    public function __construct() {
        $this->sales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Customer
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Customer
     */
    public function setDate($date) {
        if (is_string($date)) {
            $this->date = date_create_from_format('d/m/Y', $date);
        } elseif ($date instanceof \DateTime) {
            $this->date = $date;
        } else {
            $this->date = null;
        }
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate($format = 'd/m/Y') {
        if (!is_null($this->date)) {
            return $this->date->format($format);
        }
        return $this->date;
    }

    /**
     * Set country
     *
     * @param \Application\Entity\Country $country
     *
     * @return Customer
     */
    public function setCountry(\Application\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Application\Entity\Country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Add sale
     *
     * @param \Application\Entity\sale $sale
     *
     * @return Customer
     */
    public function addSale(\Application\Entity\sale $sale) {
        $this->sales[] = $sale;

        return $this;
    }

    /**
     * Remove sale
     *
     * @param \Application\Entity\sale $sale
     */
    public function removeSale(\Application\Entity\sale $sale) {
        $this->sales->removeElement($sale);
    }

    /**
     * Get sales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSales() {
        return $this->sales;
    }

    /**
     * Converts object to array (used in form populating)
     * @return Array
     */
    public function toArray() {
        return [
            'id'      => $this->getID(),
            'label'   => $this->getLabel(),
            'address' => $this->getAddress(),
            'date'    => $this->getDate(),
            'country' => $this->getCountry()->getID()];
    }

}
