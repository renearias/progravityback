<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use FOS\UserBundle\Model\User as BaseUser;
/**
* @ORM\Entity
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="usuarios2")
* @Serializer\ExclusionPolicy("all")
*/
class Usuario extends BaseUser
{
    /**
    * @var integer $id
    *
    * @ORM\Column(name="id",type="integer",options={"unsigned"=false})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    protected $id;
    /**
    * @ORM\Column(type="string",length=255)
    * @Serializer\Expose
    * @Serializer\Groups({"list","detail","estadisticas"})
    */
    private $name='';
    /**
    * @ORM\Column(name="cargo",type="string",length=255)
    */
    private $cargo = '';
    /**
    * @ORM\Column(name="trato",type="string",length=50)
    */
    private $trato = '';
    /**
    * @ORM\Column(type="string",length=255, nullable=true)
    */
    protected $path;
   
    /**
    * @ORM\Column(name="telefono", type="string", length=255)
    */
    private $telefono = '';
    /**
    * @ORM\Column(name="direccion", type="text", length=255)
    */
    private $direccion = '';

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255, nullable=false)
     */
    private $theme = '';

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=false)
     */
    private $signature = '';

    /**
     * @var string
     *
     * @ORM\Column(name="signature_format", type="string", length=255, nullable=true)
     */
    private $signatureFormat;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="access", type="integer", nullable=false)
     */
    private $access = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="login", type="integer", nullable=false)
     */
    private $login = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=32, nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=12, nullable=false)
     */
    private $language = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="picture", type="integer", nullable=false)
     */
    private $picture = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="init", type="string", length=254, nullable=true)
     */
    private $init = '';

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="json_array", nullable=true)
     */
    private $data;
    
    
     /**
     * se utilizó user_roles para no hacer conflicto al aplicar ->toArray en getRoles()
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $user_roles;
    
    protected $roles;
    
   public function __construct()
    {
     //parent::__construct();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->enabled = false;
        $this->locked = false;
        $this->expired = false;
      //  $this->roles = array();
        $this->credentialsExpired = false;
   
      
    //$this->inbox= new \Doctrine\Common\Collections\ArrayCollection();
    //$this->outbox= new \Doctrine\Common\Collections\ArrayCollection();
    $this->user_roles = new \Doctrine\Common\Collections\ArrayCollection();
    $this->roles = $this->user_roles;
    $this->setRoles($this->user_roles->toArray());
    $this->addCreated();
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
    * Set name
    *
    * @param string $name
    */
    public function setName($name)
    {
    $this->name = $name;
    }
    /**
    * Get name
    *
    * @return string
    */
    public function getName()
    {
    return $this->name;
    }
    /**
    * Set path
    *
    * @param string $path
    */
    public function setPath($path)
    {
    $this->path = $path;
    }
    /**
    * Get path
    *
    * @return string
    */
    public function getPath()
    {
    return $this->path;
    }
    
    /**
    * Set salt
    * 
    * @param string $salt
    */
    public function setSalt($salt)
    {
    $this->salt = $salt;
    }
    /**
    * Get salt
    * @return string
    */
    public function getSalt()
    {
    return $this->salt;
    }
   
    /*
    * Add user_roles
    * 
    * @param \AppBundle\Entity\Role $userRoles
    */
    public function addRole($userRoles)
    {
    $this->user_roles[] = $userRoles;
    }
    public function setUserRoles($roles) {
    $this->user_roles = $roles;
    }
    /**
    * Get user_roles
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getUserRoles()
    {
    return $this->user_roles;
    }
    /*
    * Get roles
    * @inheritDoc
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getRoles()
    {
        //return array('ROLE_USER');
        return $this->user_roles->toArray();    //IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array
    }
    
    /**
     * Add user_roles
     *
     * @param \AppBundle\Entity\Role $userRoles
     * @return User
     */
    public function addUserRole(\AppBundle\Entity\Role $userRoles)
    {
        $this->user_roles[] = $userRoles;

        return $this;
    }

    /**
     * Remove user_roles
     *
     * @param \AppBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\AppBundle\Entity\Role $userRoles)
    {
        $this->user_roles->removeElement($userRoles);
    }
    
    /**
    * Set cargo
    * 
    * @param string $cargo
    */
     public function setCargo($cargo)
    {
        $this->cargo = $cargo;
      
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }
    
    /**
    * Set trato
    * 
    * @param string $trato
    */
     public function setTrato($trato)
    {
        $this->trato = $trato;
      
    }

    /**
     * Get trato
     *
     * @return string 
     */
    public function getTrato()
    {
        return $this->trato;
    }

    /**
     * Set theme
     *
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * Get theme
     *
     * @return string 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set signature
     *
     * @param string $signature
     * @return Users
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set signatureFormat
     *
     * @param string $signatureFormat
     * @return Users
     */
    public function setSignatureFormat($signatureFormat)
    {
        $this->signatureFormat = $signatureFormat;

        return $this;
    }

    /**
     * Get signatureFormat
     *
     * @return string 
     */
    public function getSignatureFormat()
    {
        return $this->signatureFormat;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Users
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    public function addCreated()
    {
        $this->created=time();   
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set access
     *
     * @param integer $access
     * @return Users
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return integer 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set login
     * @param integer $login
     * @return Users
     */
    public function setLogin(Request $request)
    {
       $login=$request->server->get('REQUEST_TIME');
       $this->login=$login;
       return $this;
    }

    /**
     * Get login
     *
     * @return integer 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Users
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     * @return Users
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Users
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set picture
     *
     * @param integer $picture
     * @return Users
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return integer 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set init
     *
     * @param string $init
     * @return Users
     */
    public function setInit($init)
    {
        $this->init = $init;

        return $this;
    }

    /**
     * Get init
     *
     * @return string 
     */
    public function getInit()
    {
        return $this->init;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Users
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("picture")
     * @Serializer\Groups({"estadisticas"})
     */
    public function getWebPath()
    {
        return null === $this->path
            //? null
            ? $this->getUploadDir().'/male.png'
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents/images/profile';
    }
    
    /**
     * @Assert\File(maxSize="6000000",
                   mimeTypes = {"image/*"},
                   mimeTypesMessage = "Por favor suba una imagen valida")
     */
    private $file;

    private $temp;
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
     
    public function __toString() {
    return $this->getName();
    }
    
    /**
     * Set nodo
     * 
     * @param \Multiservices\IspControlBundle\Entity\Server
     * @return Usuario
     */
    public function setNodo(\Multiservices\IspControlBundle\Entity\Server $nodo)
    {
        $this->nodo = $nodo;

        return $this;
    }

    /**
     * Get nodo
     * 
     * @return \Multiservices\IspControlBundle\Entity\Server
     */
    public function getNodo()
    {
        return $this->nodo;
    }

}
