<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313155251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E10B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_album ADD CONSTRAINT FK_59945E101137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A61137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576E5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_artist ADD CONSTRAINT FK_499B576EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F5ED23C43 FOREIGN KEY (track_id) REFERENCES track (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_genre ADD CONSTRAINT FK_F3A7915F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E10B7970CF8');
        $this->addSql('ALTER TABLE artist_album DROP FOREIGN KEY FK_59945E101137ABCF');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A61137ABCF');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576E5ED23C43');
        $this->addSql('ALTER TABLE track_artist DROP FOREIGN KEY FK_499B576EB7970CF8');
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F5ED23C43');
        $this->addSql('ALTER TABLE track_genre DROP FOREIGN KEY FK_F3A7915F4296D31F');
    }
}
