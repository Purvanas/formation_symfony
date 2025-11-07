<?php

namespace App\Tests\Unit;

use App\Entity\Projet;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ProjetTest extends TestCase
{
    public function testSetAndGetNom()
    {
        $projet = new Projet();
        $projet->setNom('Projet Test');
        
        $this->assertSame('Projet Test', $projet->getNom());
    }

    public function testSetAndGetBudget()
    {
        $projet = new Projet();
        $projet->setBudget(1000.50);
        
        $this->assertSame(1000.50, $projet->getBudget());
    }

    public function testSetAndGetSeuilAlerte()
    {
        $projet = new Projet();
        $projet->setSeuilAlerte(500.00);
        
        $this->assertSame(500.00, $projet->getSeuilAlerte());
    }

    public function testSetAndGetPlan()
    {
        $projet = new Projet();
        $projet->setPlan('Plan stratégique');
        
        $this->assertSame('Plan stratégique', $projet->getPlan());
    }

    public function testSetAndGetListeDiffusion()
    {
        $projet = new Projet();
        $projet->setListeDiffusion('Diffusion A, Diffusion B');
        
        $this->assertSame('Diffusion A, Diffusion B', $projet->getListeDiffusion());
    }

    public function testSetAndGetClient()
    {
        $projet = new Projet();
        $client = new Client();
        $projet->setClient($client);
        
        $this->assertSame($client, $projet->getClient());
    }
}
