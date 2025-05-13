<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118110100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, match_day DATE NOT NULL, is_winner TINYINT(1) NOT NULL, on_play VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD visitor_team_id INT NOT NULL, ADD local_team_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FEB7F4866 FOREIGN KEY (visitor_team_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FB4B9DD23 FOREIGN KEY (local_team_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FEB7F4866 ON team (visitor_team_id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FB4B9DD23 ON team (local_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FEB7F4866');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FB4B9DD23');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP INDEX IDX_C4E0A61FEB7F4866 ON team');
        $this->addSql('DROP INDEX IDX_C4E0A61FB4B9DD23 ON team');
        $this->addSql('ALTER TABLE team DROP visitor_team_id, DROP local_team_id');
    }
}
