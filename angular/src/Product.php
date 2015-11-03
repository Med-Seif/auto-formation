<?php
/**
 * @Entity @Table(name="products")
 * */
Class Product {

    /** @Id @Column(type="integer")  @GeneratedValue * */
    protected $id;

    /** @Column(type="string",length=45,nullable=false) * */
    protected $label;

    /**
     * @ManyToOne(targetEntity="supplier", inversedBy="products")
     * @JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    protected $supplier;

    /** @OneToMany(targetEntity="sale", mappedBy="product") * */
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

    public function getSupplier() {
        return $this->supplier;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setSupplier($supplier) {
        $this->supplier = $supplier;
    }

}
