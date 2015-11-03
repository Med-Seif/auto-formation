<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="`match`")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MatchRepository")
 */
class Match {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    protected $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="buts", type="integer", nullable=true)
     */
    protected $buts;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain", inversedBy="matchs")
     * @ORM\JoinColumn(name="terrain_id", referencedColumnName="id")
     */
    protected $terrain;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="types")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="classe", type="integer", nullable=true)
     */
    protected $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="res", type="string", length=1, nullable=true)
     */
    protected $res;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true)
     */
    protected $note;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="saison", type="string", length=5, nullable=false)
     */
    protected $saison;

    /**
     * @var boolean
     *
     * @ORM\Column(name="injury", type="boolean", nullable=true)
     */
    protected $injury;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Match
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
    public function getDate() {
        return $this->date;
    }

    /**
     * Set buts
     *
     * @param integer $buts
     * @return Match
     */
    public function setButs($buts) {
        $this->buts = $buts;

        return $this;
    }

    /**
     * Get buts
     *
     * @return integer
     */
    public function getButs() {
        return $this->buts;
    }

    /**
     * Set terrain
     *
     * @param string $terrain
     * @return Match
     */
    public function setTerrain($terrain) {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return string
     */
    public function getTerrain() {
        return $this->terrain;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Match
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set classe
     *
     * @param integer $classe
     * @return Match
     */
    public function setClasse($classe) {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return integer
     */
    public function getClasse() {
        return $this->classe;
    }

    /**
     * Set res
     *
     * @param string $res
     * @return Match
     */
    public function setRes($res) {
        $this->res = $res;

        return $this;
    }

    /**
     * Get res
     *
     * @return string
     */
    public function getRes() {
        return $this->res;
    }

    /**
     * Set note
     *
     * @param float $note
     * @return Match
     */
    public function setNote($note) {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Match
     */
    public function setComment($comment) {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * Set saison
     *
     * @param string $saison
     * @return Match
     */
    public function setSaison($saison) {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return string
     */
    public function getSaison() {
        return $this->saison;
    }

    /**
     * Set injury
     *
     * @param boolean $injury
     * @return Match
     */
    public function setInjury($injury) {
        $this->injury = $injury;

        return $this;
    }

    /**
     * Get injury
     *
     * @return boolean
     */
    public function getInjury() {
        return $this->injury;
    }

    public function __toString() {
        return $this->saison;
    }
}
