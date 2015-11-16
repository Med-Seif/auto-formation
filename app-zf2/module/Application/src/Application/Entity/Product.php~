<?php

/**
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\ProductRepository")
 * */
Class Product {

    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue (strategy="AUTO")
     * */
    protected $id;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     * */
    protected $label;

    /**
     *  @ORM\Column(type="float",nullable=false)
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="supplier", inversedBy="products")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    protected $supplier;

    /**
     * @ORM\OneToMany(targetEntity="sale", mappedBy="product")
     */
    protected $sales;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Product
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set supplier
     *
     * @param \Application\Entity\supplier $supplier
     *
     * @return Product
     */
    public function setSupplier(\Application\Entity\supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \Application\Entity\supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Add sale
     *
     * @param \Application\Entity\sale $sale
     *
     * @return Product
     */
    public function addSale(\Application\Entity\sale $sale)
    {
        $this->sales[] = $sale;

        return $this;
    }

    /**
     * Remove sale
     *
     * @param \Application\Entity\sale $sale
     */
    public function removeSale(\Application\Entity\sale $sale)
    {
        $this->sales->removeElement($sale);
    }

    /**
     * Get sales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSales()
    {
        return $this->sales;
    }
}
