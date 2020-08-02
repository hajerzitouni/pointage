<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Societe
 * @ORM\Entity
 */
class Societe
{
    const SERVER_PATH_TO_IMAGE_FOLDER = 'C:\wamp664\www\pointage2\pointage2\web\images';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
     */
    private $adresse;
    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @return string|null
     */
    public function getTel(): ?string
    {
        return $this->tel;
    }

    /**
     * @param string|null $tel
     */
    public function setTel(?string $tel): void
    {
        $this->tel = $tel;
    }
    /**
     * @Assert\File(maxSize="700K")
     */
    public $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomsoc", type="string", length=45, nullable=true)
     */
    private $nomsoc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation", type="datetime", nullable=true)
     */
    private $creation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siteweb", type="string", length=45, nullable=true)
     */
    private $siteweb;

    /**
     * @return string|null
     */
    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    /**
     * @param string|null $siteweb
     */
    public function setSiteweb(?string $siteweb): void
    {
        $this->siteweb = $siteweb;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomsoc(): ?string
    {
        return $this->nomsoc;
    }

    public function setNomsoc(?string $nomsoc): self
    {
        $this->nomsoc = $nomsoc;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(?\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="societes")
     */
    private $creator;

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }
    /**
     * @var
     * @ORM\ManyToMany(targetEntity="User",inversedBy="societes")
     * @ORM\JoinTable(name="user_societe",
     *     joinColumns={
     *          @ORM\JoinColumn(name="societe_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     }
     * )
     */
    private $users;

    public function setUsers($users)
    {
        $this->users = $users;
    }

    public function __construct()
    {
        $this->users= new ArrayCollection();
        $this->societes= new ArrayCollection();

    }
    /**
     * @return ArrayCollection|users[]
     *
     */
    public function getUsers()
    {
        return $this->users;
    }





    public function addUser( $user)
    {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
       // $user->addEvent($this);
    }



    public function removeUser( $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }

        $this->users->removeElement($user);
        $user->removeevent($this);
    }


    public function __toString()
    {
        return $this->nomsoc;

    }

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    public function getWebPath(){

        return null===$this->image ? null :$this->getUploadDir().'/'.$this->image;
    }
    protected function getUploadRootDir(){

        return dirname(__FILE__) .'/../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir(){

        return 'images';
    }
    public function uploadProfilePicture(){
        // $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        //  $this->image=$this->file->getClientOriginalName();
        $this->file=null;
    }


}
