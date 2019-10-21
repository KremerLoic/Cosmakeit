<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927230311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shopuser_product');
        $this->addSql('ALTER TABLE sylius_shop_user CHANGE favorite Favorite LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shopuser_product (shopuser_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_78D5E49DBFF1294 (shopuser_id), INDEX IDX_78D5E494584665A (product_id), PRIMARY KEY(shopuser_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE shopuser_product ADD CONSTRAINT FK_78D5E494584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopuser_product ADD CONSTRAINT FK_78D5E49DBFF1294 FOREIGN KEY (shopuser_id) REFERENCES sylius_shop_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sylius_shop_user CHANGE Favorite favorite LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:array)\'');
    }
}
