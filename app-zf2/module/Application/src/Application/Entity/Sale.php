<?php

/**
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Zend\Form\Annotation as Form;
use Doctrine\ORM\Mapping as ORM;

/**
 *  @Form\Name("sale")
 *
 * @ORM\Entity
 * @ORM\Table(name="sales")
 * */
Class Sale {

    /** @ORM\Id
     *  @ORM\Column(type="integer")
     *  @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Options({
     *      "label":"Product",
     *      "target_class":"Application\Entity\Product",
     *      "property":"label",
     *      "find_method":{
     *          "name" : "findAll"
     *      }
     * })
     * @Form\Attributes({"class":"form-control"})
     *
     * @ORM\ManyToOne(targetEntity="product",inversedBy="sales")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @Form\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Form\Options({
     *      "label":"Customer",
     *      "target_class":"Application\Entity\Customer",
     *      "property":"label",
     *      "find_method":{
     *          "name" : "findAll"
     *      }
     * })
     * @Form\Attributes({"class":"form-control"})
     *
     * @ORM\ManyToOne(targetEntity="customer",inversedBy="sales")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;

    /**
     * @Form\Attributes({"type":"text","class":"form-control"})
     * @Form\Options({"label":"Quantity"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"Digits"})
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $quantity;

    /**
     * @Form\Type("Zend\Form\Element\Date")
     * @Form\Attributes({"class":"form-control"})
     * @Form\Options({"label":"Date","format":"d/m/Y"})
     * @Form\Attributes({"step":"any"})
     * @Form\Filter({"name":"StringTrim"})
     *
     * @ORM\Column(type="date",nullable=false)
     */
    protected $date;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Sale
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sale
     */
    public function setDate($date) {
        $this->date = $date;

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
     * Set product
     *
     * @param \Application\Entity\product $product
     *
     * @return Sale
     */
    public function setProduct(\Application\Entity\product $product = null) {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Application\Entity\product
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * Set customer
     *
     * @param \Application\Entity\customer $customer
     *
     * @return Sale
     */
    public function setCustomer(\Application\Entity\customer $customer = null) {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Application\Entity\customer
     */
    public function getCustomer() {
        return $this->customer;
    }

    public function toArray() {
        return [
            'id'       => $this->getID(),
            'product'  => $this->getProduct()->getID(),
            'quantity' => $this->getQuantity(),
            'date'     => $this->getDate(),
            'customer' => $this->getCustomer()->getID()];
    }

}
