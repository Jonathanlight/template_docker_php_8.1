<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private ?UserRepository $userRepository;
    private ?object $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $this->userRepository = $kernel->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(User::class);
    }

    public function testFindAllReturnsArray()
    {
        $users = $this->userRepository->findAll();
        $this->assertIsArray($users);
    }

    public function testFindByFullname()
    {
        $fullname = 'John Demo';
        $user = $this->userRepository->getUserByFullname($fullname);
        $this->assertNotNull($user);
        $this->assertEquals($fullname, $user->getFullname());
    }

    public function testCreateUser()
    {
        $uniqueId = uniqid();
        $user = new User();
        $user->setEmail('newuser-'.$uniqueId.'@mail.fr');
        $user->setPassword('password');
        $user->setFullname('New User '.$uniqueId);
        $user->setRoles(['ROLE_USER']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $retrievedUser = $this->userRepository->getUserByFullname('New User '.$uniqueId);
        $this->assertNotNull($retrievedUser);
        $this->assertEquals('New User '.$uniqueId, $retrievedUser->getFullname());
    }
}