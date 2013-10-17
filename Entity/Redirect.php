<?php

namespace BOMO\RedirectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="BOMO\RedirectBundle\Repository\RedirectRepository")
 * @ORM\Table(name="Redirect")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("urlSource")
 */
class Redirect
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank(message="redirect.url_source.not_blank")
     */
    protected $urlSource;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank(message="redirect.url_target.not_blank")
     */
    protected $urlTarget;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     * @Assert\NotBlank(message="redirect.code.not_blank")
     * @Assert\Choice(callback="getStatusList")
     */
    protected $code;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type("bool")
     * @Assert\NotNull()
     */
    protected $isActive;

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
     * Set urlSource
     *
     * @param string $urlSource
     * @return Redirect
     */
    public function setUrlSource($urlSource)
    {
        $this->urlSource = $urlSource;
    
        return $this;
    }

    /**
     * Get urlSource
     *
     * @return string 
     */
    public function getUrlSource()
    {
        return $this->urlSource;
    }

    /**
     * Set urlTarget
     *
     * @param string $urlTarget
     * @return Redirect
     */
    public function setUrlTarget($urlTarget)
    {
        $this->urlTarget = $urlTarget;
    
        return $this;
    }

    /**
     * Get urlTarget
     *
     * @return string 
     */
    public function getUrlTarget()
    {
        return $this->urlTarget;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Redirect
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Redirect
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public static function getStatusList()
    {
        return array_keys(\BOMO\RedirectBundle\Util\RedirectStatus::getRedirectStatus());
    }
}