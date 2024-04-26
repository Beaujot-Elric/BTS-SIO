<?php
// src/Entity/Employe.php
namespace App\Entity;

// définition d'un alias
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pilotes")
 */
class Pilote
{
    // attributs privés
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(name="nom", type="string", length=25)
     */
    private $nom;
    /**
     * @ORM\Column(name="prenom", type="string", length=25)
     */
    private $prenom;
    /**
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\Column(name="ecurie", type="string", length=25)
     */
    private $ecurie;

    // getters et setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function getPoints()
    {
        return $this->points;
    }
    public function setPoints($points)
    {
        $this->points = $points;
    }
    public function getEcurie()
    {
        return $this->ecurie;
    }
    public function setEcurie($ecurie)
    {
        $this->ecurie = $ecurie;
    }
}