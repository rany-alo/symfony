<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919124329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_article_id INT NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5F9E962A79F37AE5 (id_user_id), INDEX IDX_5F9E962AD71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD71E064B FOREIGN KEY (id_article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316879F37AE5');
        $this->addSql('DROP INDEX IDX_BFDD316879F37AE5 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE id_user id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316879F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316879F37AE5 ON articles (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AD71E064B');
        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316879F37AE5');
        $this->addSql('DROP INDEX IDX_BFDD316879F37AE5 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE id_user_id id_user INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316879F37AE5 FOREIGN KEY (id_user) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316879F37AE5 ON articles (id_user)');
    }
}
