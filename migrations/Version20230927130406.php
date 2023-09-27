<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927130406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favourites (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, advertisements_id INT DEFAULT NULL, INDEX IDX_7F07C50167B3B43D (users_id), INDEX IDX_7F07C5016DB58F3E (advertisements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favourites ADD CONSTRAINT FK_7F07C50167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE favourites ADD CONSTRAINT FK_7F07C5016DB58F3E FOREIGN KEY (advertisements_id) REFERENCES advertisements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favourites DROP FOREIGN KEY FK_7F07C50167B3B43D');
        $this->addSql('ALTER TABLE favourites DROP FOREIGN KEY FK_7F07C5016DB58F3E');
        $this->addSql('DROP TABLE favourites');
    }
}
