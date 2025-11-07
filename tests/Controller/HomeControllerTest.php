<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class HomeControllerTest extends WebTestCase
{
    private function logIn(): object
    {
        $client = static::createClient();
        $em = $client->getContainer()->get('doctrine')->getManager();

        $user = $em->getRepository(User::class)->findOneBy(['email' => 'test@example.com']);
        if (!$user) {
            $user = new User();
            $user->setEmail('test@example.com');
            $user->setRoles(['ROLE_ADMIN']);

            $passwordHasher = $client->getContainer()->get(UserPasswordHasherInterface::class);
            $user->setPassword($passwordHasher->hashPassword($user, 'password'));

            $em->persist($user);
            $em->flush();
        }

        $client->loginUser($user);
        return $client;
    }

    public function testIndex(): void
    {
        $client = $this->logIn();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }
}
