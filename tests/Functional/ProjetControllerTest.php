<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProjetControllerTest extends WebTestCase
{
    private function logIn(): \Symfony\Bundle\FrameworkBundle\KernelBrowser
    {
        $client = static::createClient();
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        // Vérifie si un utilisateur de test existe déjà
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => 'test@example.com']);

        if (!$user) {
            $user = new User();
            $user->setEmail('test@example.com');
            $user->setRoles(['ROLE_ADMIN']);

            $passwordHasher = $client->getContainer()->get(UserPasswordHasherInterface::class);
            $user->setPassword($passwordHasher->hashPassword($user, 'password'));

            $entityManager->persist($user);
            $entityManager->flush();
        }

        $client->loginUser($user);
        return $client;
    }

    private function createTestClient(EntityManagerInterface $entityManager): Client
    {
        $client = new Client();
        $client->setNom('Client Test');
        $client->setSiren('123456789');
        $client->setIban('FR7630001007941234567890185');
        $client->setAdresse('123 Rue de Symfony, 75000 Paris');
        $client->setContactFacturation('facturation@test.com');

        $entityManager->persist($client);
        $entityManager->flush();

        return $client;
    }

    public function testProjetCreationPageLoads(): void
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/projets/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Ajouter un projet');
    }

    public function testProjetFormSubmission(): void
    {
        $client = $this->logIn();
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        $testClient = $this->createTestClient($entityManager);

        $crawler = $client->request('GET', '/projets/new');

        $form = $crawler->selectButton('Enregistrer')->form([
            'projet[nom]' => 'Test Projet',
            'projet[budget]' => 5000,
            'projet[seuilAlerte]' => 2000,
            'projet[plan]' => 'Plan de test',
            'projet[listeDiffusion]' => 'Test Diffusion',
            'projet[client]' => $testClient->getId()
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/projets/');
        $client->followRedirect();

        $this->assertSelectorExists('td:contains("Test Projet")');
    }
}
