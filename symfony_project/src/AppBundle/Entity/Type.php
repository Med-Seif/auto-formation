<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity
 */
class Type {

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=1, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lib", type="string", length=50, nullable=false)
     */
    protected $lib;

    /**
     *
     * @ORM\OneToMany(targetEntity="Match", mappedBy="type")
     */
    protected $matchs;

    /**
     * Constructor
     */
    public function __construct() {
        $this->matchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set lib
     *
     * @param string $lib
     * @return Type
     */
    public function setLib($lib) {
        $this->lib = $lib;

        return $this;
    }

    /**
     * Get lib
     *
     * @return string
     */
    public function getLib() {
        return $this->lib;
    }

    /**
     * Add matchs
     *
     * @param \AppBundle\Entity\Match $matchs
     * @return Type
     */
    public function addMatch(\AppBundle\Entity\Match $matchs) {
        $this->matchs[] = $matchs;

        return $this;
    }

    /**
     * Remove matchs
     *
     * @param \AppBundle\Entity\Match $matchs
     */
    public function removeMatch(\AppBundle\Entity\Match $matchs) {
        $this->matchs->removeElement($matchs);
    }

    /**
     * Get matchs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatchs() {
        return $this->matchs;
    }
    /**
     *
     * @return string
     */
    public function __toString() {
        return $this->lib;
    }
}
