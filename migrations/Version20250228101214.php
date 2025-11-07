<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228101214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel_de_fond (id INT AUTO_INCREMENT NOT NULL, id_projet_id INT DEFAULT NULL, date_emission DATE NOT NULL, date_paiement DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_7602A31F80F43E55 (id_projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE batch_formation (id INT AUTO_INCREMENT NOT NULL, id_projet_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, cout DOUBLE PRECISION NOT NULL, recap VARCHAR(255) NOT NULL, INDEX IDX_D79AE8980F43E55 (id_projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, contact_facturation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comission (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_8727369A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, id_projet_id INT DEFAULT NULL, date_facture DATE NOT NULL, INDEX IDX_FE86641080F43E55 (id_projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, cout DOUBLE PRECISION NOT NULL, date_formation DATE NOT NULL, tva DOUBLE PRECISION NOT NULL, cout_ht DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, budget DOUBLE PRECISION NOT NULL, seuil_alerte DOUBLE PRECISION NOT NULL, plan VARCHAR(255) NOT NULL, liste_diffusion VARCHAR(255) NOT NULL, INDEX IDX_50159CA999DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appel_de_fond ADD CONSTRAINT FK_7602A31F80F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE batch_formation ADD CONSTRAINT FK_D79AE8980F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE comission ADD CONSTRAINT FK_8727369A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641080F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA999DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel_de_fond DROP FOREIGN KEY FK_7602A31F80F43E55');
        $this->addSql('ALTER TABLE batch_formation DROP FOREIGN KEY FK_D79AE8980F43E55');
        $this->addSql('ALTER TABLE comission DROP FOREIGN KEY FK_8727369A19EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641080F43E55');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA999DED506');
        $this->addSql('DROP TABLE appel_de_fond');
        $this->addSql('DROP TABLE batch_formation');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE comission');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
