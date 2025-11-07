<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250228135838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batch_formation DROP FOREIGN KEY FK_D79AE8980F43E55');
        $this->addSql('DROP INDEX IDX_D79AE8980F43E55 ON batch_formation');
        $this->addSql('ALTER TABLE batch_formation ADD projet_id INT NOT NULL, DROP id_projet_id');
        $this->addSql('ALTER TABLE batch_formation ADD CONSTRAINT FK_D79AE89C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_D79AE89C18272 ON batch_formation (projet_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641080F43E55');
        $this->addSql('DROP INDEX IDX_FE86641080F43E55 ON facture');
        $this->addSql('ALTER TABLE facture ADD projet_id INT NOT NULL, DROP id_projet_id');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_FE866410C18272 ON facture (projet_id)');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA999DED506');
        $this->addSql('DROP INDEX IDX_50159CA999DED506 ON projet');
        $this->addSql('ALTER TABLE projet ADD client_id INT NOT NULL, DROP id_client_id');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_50159CA919EB6921 ON projet (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batch_formation DROP FOREIGN KEY FK_D79AE89C18272');
        $this->addSql('DROP INDEX IDX_D79AE89C18272 ON batch_formation');
        $this->addSql('ALTER TABLE batch_formation ADD id_projet_id INT DEFAULT NULL, DROP projet_id');
        $this->addSql('ALTER TABLE batch_formation ADD CONSTRAINT FK_D79AE8980F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_D79AE8980F43E55 ON batch_formation (id_projet_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410C18272');
        $this->addSql('DROP INDEX IDX_FE866410C18272 ON facture');
        $this->addSql('ALTER TABLE facture ADD id_projet_id INT DEFAULT NULL, DROP projet_id');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641080F43E55 FOREIGN KEY (id_projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_FE86641080F43E55 ON facture (id_projet_id)');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA919EB6921');
        $this->addSql('DROP INDEX IDX_50159CA919EB6921 ON projet');
        $this->addSql('ALTER TABLE projet ADD id_client_id INT DEFAULT NULL, DROP client_id');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA999DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_50159CA999DED506 ON projet (id_client_id)');
    }
}
