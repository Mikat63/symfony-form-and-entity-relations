<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313153934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, year INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artist_album (artist_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_59945E10B7970CF8 (artist_id), INDEX IDX_59945E101137ABCF (album_id), PRIMARY KEY (artist_id, album_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, album_id INT DEFAULT NULL, INDEX IDX_D6E3F8A61137ABCF (album_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE track_genre (track_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_F3A7915F5ED23C43 (track_id), INDEX IDX_F3A7915F4296D31F (genre_id), PRIMARY KEY (track_id, genre_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE track_artist (track_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_499B576E5ED23C43 (track_id), INDEX IDX_499B576EB7970CF8 (artist_id), PRIMARY KEY (track_id, artist_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E10B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E101137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576E5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E10B7970CF8');
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E101137ABCF');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A61137ABCF');
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F5ED23C43');
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F4296D31F');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576E5ED23C43');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576EB7970CF8');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_album');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE track_genre');
        $this->addSql('DROP TABLE track_artist');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
