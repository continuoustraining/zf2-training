<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 08/03/16
 * Time: 11:50
 */

namespace ApplicationTest\Service;

use Application\Entity\User;
use Application\Service\UserManager;
use Doctrine\Common\Collections\ArrayCollection;

class UserManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testRepositorySetterReallySetRepositoryProperty()
    {
        $userManager = new UserManager();
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->assertSame($userManager, $userManager->setRepository($repository));
        
        $this->assertAttributeSame($repository, 'repository', $userManager);
    }
    
    public function testGetListActuallyGetUserListFromDatabase()
    {
        $userManager = new UserManager();
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $userManager->setRepository($repository);
        $result = new ArrayCollection();
        
        $repository->expects($this->once())
            ->method('findAll')
            ->willReturn($result);
        
        $this->assertSame($result, $userManager->getList());
    }
    
    public function testGetActuallyGetAUserFromDatabase()
    {
        $userManager = new UserManager();
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $userManager->setRepository($repository);
        
        $result = new User();
        $id = 42;
        
        $repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($result);
        
        $this->assertSame($result, $userManager->get($id));
    }

    /**
     * @expectedException \Application\Service\Exception
     */
    public function testGetListThrowsExceptionWhenNoRepositoryIsProvided()
    {
        $userManager = new UserManager();
        $userManager->getList();
    }
}