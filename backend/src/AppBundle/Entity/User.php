<?php

namespace AppBundle\Entity;
use AppBundle\Entity\Employee;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{

/**
 * @ORM\OneToOne(targetEntity="Employee")
 * @ORM\JoinColumn(name="emp_id", referencedColumnName="id")
 */
    private $employee;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $emp_id;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

     /** 
    * Set username 
    * 
    * @param string $username 
    * 
    * @return User 
    */ 
        
    public function setUsername($username) { 
        $this->username = $username;  
        return $this; 
    }  
    
    /** 
        * Get username 
        * 
        * @return string 
    */ 
    
    public function getUsername() { 
        return $this->username; 
    }  

    /** 
        * Get emp_id 
        * 
        * @return integer 
    */ 
    
    public function getEmp_id() { 
        return $this->emp_id; 
    }  
}

