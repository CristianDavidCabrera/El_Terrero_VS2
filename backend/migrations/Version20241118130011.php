<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118130011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, game_id_id INT DEFAULT NULL, id_team_id INT DEFAULT NULL, points INT DEFAULT NULL, is_local TINYINT(1) NOT NULL, INDEX IDX_329937514D77E7D8 (game_id_id), UNIQUE INDEX UNIQ_32993751F7F171DE (id_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937514D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751F7F171DE FOREIGN KEY (id_team_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937514D77E7D8');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751F7F171DE');
        $this->addSql('DROP TABLE score');
    }
}
