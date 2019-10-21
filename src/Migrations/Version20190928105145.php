<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928105145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE favorite_product (favorite_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8E1EAAC3AA17481D (favorite_id), INDEX IDX_8E1EAAC34584665A (product_id), PRIMARY KEY(favorite_id, product_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC3AA17481D FOREIGN KEY (favorite_id) REFERENCES Favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_product ADD CONSTRAINT FK_8E1EAAC34584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE favorite_product');
    }
}
