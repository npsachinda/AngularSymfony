<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employee")
 */
class Employee
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

        /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @ORM\Column(type="text")
     */
    private $address;


    public function getId()
    {
        return $this->id;
    }

    /** 
    * Set firstname 
    * 
    * @param string $firstname 
    * 
    * @return Employee 
    */ 
        
    public function setFirstname($firstname) { 
        $this->firstname = $firstname;  
        return $this; 
    }  
    
    /** 
        * Get firstname 
        * 
        * @return string 
    */ 
    
    public function getFirstname() { 
        return $this->firstname; 
    }  

    /** 
    * Set lastname 
    * 
    * @param string $lastname
    * 
    * @return Employee 
    */ 
        
    public function setLastname($lastname) { 
        $this->name = $lastname;  
        return $this; 
    }  
    
    /** 
        * Get lastname 
        * 
        * @return string 
    */ 
    
    public function getLastname() { 
        return $this->lastname; 
    }

        /**
         * Set address 
        * 
        * @param string $address 
        * 
        * @return Employee 
    */ 
        
    public function setAddress($address) { 
        $this->address = $address;  
        return $this; 
    }  
    
    /** 
        * Get address 
        * 
        * @return text 
    */ 
    
    public function getAddress() { 
        return $this->address; 
    } 

}

