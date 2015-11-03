<?php

/**
 * @Entity @Table(name="sales")
 * */
Class Sale {

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /**
     * @ManyToOne(targetEntity="product",inversedBy="sales")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ManyToOne(targetEntity="customer",inversedBy="sales")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;

    /** @Column(type="integer", nullable=false) * */
    protected $quatity;

    /** @Column(type="date",nullable=false) * */
    protected $date;

    public function getID() {
        return $this->id;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getQuatity() {
        return $this->quatity;
    }

    public function setProduct($product) {
        $this->product = $product;
    }

    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    public function setQuatity($quantity) {
        $this->quatity = $quantity;
    }

}
