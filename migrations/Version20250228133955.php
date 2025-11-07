<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228133955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel_de_fond DROP FOREIGN KEY FK_7602A31F80F43E55');
        $this->addSql('DROP INDEX IDX_7602A31F80F43E55 ON appel_de_fond');
        $this->addSql('ALTER TABLE appel_de_fond ADD projet_id INT NOT NULL, DROP id_projet_id');
        $this->addSql('ALTER TABLE appel_de_fond ADD CONSTRAINT FK_7602A31FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_7602A31FC18272 ON appel_de_fond (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel_de_fond DROP FOREIGN KEY FK_7602A31FC18272');
        $this->addSql('DROP INDEX IDX_7602A31FC18272 ON appel_de_fond');
        $this->addSql('ALTER TABLE appel_de_fond ADD id_projet_id INT DEFAULT NULL, DROP projet_id');
        $this->addSql('ALTER TABLE appel_de_fond ADD CONSTRAINT FK_7602A31F80F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_7602A31F80F43E55 ON appel_de_fond (id_projet_id)');
    }
}
