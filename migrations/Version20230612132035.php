<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612132035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F32B110F5');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DDADC94DA');
        $this->addSql('CREATE TABLE announcement (id INT AUTO_INCREMENT NOT NULL, breeder_id INT NOT NULL, title VARCHAR(255) NOT NULL, info LONGTEXT NOT NULL, dateannouncement DATETIME NOT NULL, INDEX IDX_4DB9D91C33C95BB1 (breeder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C33C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id)');
        $this->addSql('ALTER TABLE anoucement DROP FOREIGN KEY FK_A61404533C95BB1');
        $this->addSql('DROP TABLE anoucement');
        $this->addSql('DROP INDEX IDX_812C397DDADC94DA ON dog');
        $this->addSql('ALTER TABLE dog CHANGE anoucement_id announcement_id INT NOT NULL');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE INDEX IDX_812C397D913AEA17 ON dog (announcement_id)');
        $this->addSql('DROP INDEX IDX_3B978F9F32B110F5 ON request');
        $this->addSql('ALTER TABLE request CHANGE annoucement_id announcement_id INT NOT NULL');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcement (id)');
        $this->addSql('CREATE INDEX IDX_3B978F9F913AEA17 ON request (announcement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D913AEA17');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F913AEA17');
        $this->addSql('CREATE TABLE anoucement (id INT AUTO_INCREMENT NOT NULL, breeder_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, info LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_anoucement DATETIME NOT NULL, INDEX IDX_A61404533C95BB1 (breeder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE anoucement ADD CONSTRAINT FK_A61404533C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C33C95BB1');
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP INDEX IDX_3B978F9F913AEA17 ON request');
        $this->addSql('ALTER TABLE request CHANGE announcement_id annoucement_id INT NOT NULL');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F32B110F5 FOREIGN KEY (annoucement_id) REFERENCES anoucement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3B978F9F32B110F5 ON request (annoucement_id)');
        $this->addSql('DROP INDEX IDX_812C397D913AEA17 ON dog');
        $this->addSql('ALTER TABLE dog CHANGE announcement_id anoucement_id INT NOT NULL');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DDADC94DA FOREIGN KEY (anoucement_id) REFERENCES anoucement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_812C397DDADC94DA ON dog (anoucement_id)');
    }
}
