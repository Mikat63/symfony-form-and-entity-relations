<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313140615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_track (album_id INT NOT NULL, track_id INT NOT NULL, INDEX IDX_A05BB2801137ABCF (album_id), INDEX IDX_A05BB2805ED23C43 (track_id), PRIMARY KEY (album_id, track_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE album_track ADD CONSTRAINT FK_A05BB2801137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_track ADD CONSTRAINT FK_A05BB2805ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E10B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E101137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album_track DROP FOREIGN KEY FK_A05BB2801137ABCF');
        $this->addSql('ALTER TABLE album_track DROP FOREIGN KEY FK_A05BB2805ED23C43');
        $this->addSql('DROP TABLE album_track');
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E10B7970CF8');
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E101137ABCF');
    }
}
