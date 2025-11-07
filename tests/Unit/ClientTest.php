<?php

namespace App\Tests\Unit;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSetAndGetNom()
    {
        $client = new Client();
        $client->setNom('Client A');
        $this->assertSame('Client A', $client->getNom());
    }

    public function testSetAndGetSiren()
    {
        $client = new Client();
        $client->setSiren('123456789');
        $this->assertSame('123456789', $client->getSiren());
    }

    public function testSetAndGetAdresse()
    {
        $client = new Client();
        $client->setAdresse('123 rue test');
        $this->assertSame('123 rue test', $client->getAdresse());
    }

    public function testSetAndGetIban()
    {
        $client = new Client();
        $client->setIban('FR7630001007941234567890185');
        $this->assertSame('FR7630001007941234567890185', $client->getIban());
    }

    public function testSetAndGetContactFacturation()
    {
        $client = new Client();
        $client->setContactFacturation('facture@exemple.com');
        $this->assertSame('facture@exemple.com', $client->getContactFacturation());
    }
}
