<?php

namespace ApplicationTest\Entity;
use Application\Entity\User;

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 08/03/16
 * Time: 14:02
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testIdGetterActuallyReturnIdProperty()
    {
        $user = new User();
        
        $id = 10;
        $this->setProperty($user, 'id', $id);
        
        $this->assertEquals($id, $user->getId());
    }
    
    public function testFirstnameGetterActuallyReturnFirstnameProperty()
    {
        $user = new User();
        
        $firstname = 'Fred';
        $this->setProperty($user, 'firstname', $firstname);
        
        $this->assertEquals($firstname, $user->getFirstname());
    }
    
    public function testFirstnameSetterActuallySetFirstnameProperty()
    {
        $user = new User();
        
        $firstname = 'Fred';
        $this->assertSame($user, $user->setFirstname($firstname));
        $this->assertAttributeEquals($firstname, 'firstname', $user);
    }
    
    public function testLaststnameGetterActuallyReturnLastnameProperty()
    {
        $user = new User();
        
        $lastname = 'Dewinne';
        $this->setProperty($user, 'lastname', $lastname);
        
        $this->assertEquals($lastname, $user->getLastname());
    }

    public function testLastnameSetterActuallySetLastnameProperty()
    {
        $user = new User();

        $lastname = 'Dewinne';
        $this->assertSame($user, $user->setLastname($lastname));
        $this->assertAttributeEquals($lastname, 'lastname', $user);
    }
    
    protected function setProperty($object, $property, $value)
    {
        $reflection = new \ReflectionObject($object);
        $reflectedProperty = $reflection->getProperty($property);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($object, $value);
    }
}