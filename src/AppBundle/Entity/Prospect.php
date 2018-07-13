<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prospect
 *
 * @ORM\Table(name="prospect")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProspectRepository")
 */
class Prospect
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="sociopro", type="string", length=255, nullable=true)
     */
    private $sociopro;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nbpersonnes", type="integer")
     */
    private $nbpersonnes;

    /**
     * @var int
     *
     * @ORM\Column(name="nbjeunes", type="integer")
     */
    private $nbjeunes;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=255)
     */
    private $quartier;

    /**
     * @var string
     *
     * @ORM\Column(name="preference", type="string", length=255)
     */
    private $preference;

    /**
     * @var string
     *
     * @ORM\Column(name="raison", type="string", length=255, nullable=true)
     */
    private $raison;

    /**
     * @var string
     *
     * @ORM\Column(name="modepaiement", type="string", length=255, nullable=true)
     */
    private $modepaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;


 public function __construct()
    {
       $this->date=new \DateTime();
        // your own logic
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
     * Set nom
     *
     * @param string $nom
     * @return Prospect
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Prospect
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set sociopro
     *
     * @param string $sociopro
     * @return Prospect
     */
    public function setSociopro($sociopro)
    {
        $this->sociopro = $sociopro;

        return $this;
    }

    /**
     * Get sociopro
     *
     * @return string 
     */
    public function getSociopro()
    {
        return $this->sociopro;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Prospect
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Prospect
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nbpersonnes
     *
     * @param integer $nbpersonnes
     * @return Prospect
     */
    public function setNbpersonnes($nbpersonnes)
    {
        $this->nbpersonnes = $nbpersonnes;

        return $this;
    }

    /**
     * Get nbpersonnes
     *
     * @return integer 
     */
    public function getNbpersonnes()
    {
        return $this->nbpersonnes;
    }

    /**
     * Set nbjeunes
     *
     * @param integer $nbjeunes
     * @return Prospect
     */
    public function setNbjeunes($nbjeunes)
    {
        $this->nbjeunes = $nbjeunes;

        return $this;
    }

    /**
     * Get nbjeunes
     *
     * @return integer 
     */
    public function getNbjeunes()
    {
        return $this->nbjeunes;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     * @return Prospect
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string 
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set preference
     *
     * @param string $preference
     * @return Prospect
     */
    public function setPreference($preference)
    {
        $this->preference = $preference;

        return $this;
    }

    /**
     * Get preference
     *
     * @return string 
     */
    public function getPreference()
    {
        return $this->preference;
    }

    /**
     * Set raison
     *
     * @param string $raison
     * @return Prospect
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string 
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set modepaiement
     *
     * @param string $modepaiement
     * @return Prospect
     */
    public function setModepaiement($modepaiement)
    {
        $this->modepaiement = $modepaiement;

        return $this;
    }

    /**
     * Get modepaiement
     *
     * @return string 
     */
    public function getModepaiement()
    {
        return $this->modepaiement;
    }
}
