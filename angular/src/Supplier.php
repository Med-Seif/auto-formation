<?php

/**
 * @Entity @Table(name="suppliers")
 * */
Class Supplier {

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string",length=45,nullable=false) * */
    protected $libelle;

    /** @OneToMany(targetEntity="product", mappedBy="supplier") * */
    protected $products;

    public function __construct() {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getID() {
        return $this->id;
    }

    public function getLib() {
        return $this->libelle;
    }

    public function setLib($libelle) {
        $this->libelle = $libelle;
    }

}
