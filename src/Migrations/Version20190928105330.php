<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928105330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite_product DROP FOREIGN KEY FK_8E1EAAC3AA17481D');
        $this->addSql('ALTER TABLE favorite_shopuser DROP FOREIGN KEY FK_F954077CAA17481D');
        $this->addSql('DROP TABLE Favorite');
        $this->addSql('DROP TABLE favorite_product');
        $this->addSql('DROP TABLE favorite_shopuser');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Favorite (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorite_product (favorite_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8E1EAAC3AA17481D (favorite_id), INDEX IDX_8E1EAAC34584665A (product_id), PRIMARY KEY(favorite_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorite_shopuser (favorite_id INT NOT NULL, shopuser_id INT NOT NULL, INDEX IDX_F954077CAA17481D (favorite_id), INDEX IDX_F954077CDBFF1294 (shopuser_id), PRIMARY KEY(favorite_id, shopuser_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC34584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC3AA17481D FOREIGN KEY (favorite_id) REFERENCES Favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_shopuser ADD CONSTRAINT FK_F954077CAA17481D FOREIGN KEY (favorite_id) REFERENCES Favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_shopuser ADD CONSTRAINT FK_F954077CDBFF1294 FOREIGN KEY (shopuser_id) REFERENCES sylius_shop_user (id) ON DELETE CASCADE');
    }
}
