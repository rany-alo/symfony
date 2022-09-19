<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919123801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, article VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BFDD316879F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316879F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E989E8BDC');
        $this->addSql('DROP INDEX IDX_1483A5E989E8BDC ON users');
        $this->addSql('ALTER TABLE users CHANGE id_role id_role_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E989E8BDC FOREIGN KEY (id_role_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E989E8BDC ON users (id_role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316879F37AE5');
        $this->addSql('DROP TABLE articles');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E989E8BDC');
        $this->addSql('DROP INDEX IDX_1483A5E989E8BDC ON users');
        $this->addSql('ALTER TABLE users CHANGE id_role_id id_role INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E989E8BDC FOREIGN KEY (id_role) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E989E8BDC ON users (id_role)');
    }
}
