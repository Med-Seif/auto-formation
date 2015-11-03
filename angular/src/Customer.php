<?php

/**
 * @Entity @Table(name="customers")
 * */
Class Customer {

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string",length=45,nullable=false) * */
    protected $label;

    /** @Column(type="string",length=45,nullable=false) * */
    protected $address;

    /** @Column(type="string",length=3,nullable=false) * */
    protected $country;

    /** @OneToMany(targetEntity="sale", mappedBy="customer") * */
    protected $sales;

    public function __construct() {
        $this->sales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getID() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

}
