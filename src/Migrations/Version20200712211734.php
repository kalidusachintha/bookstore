<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712211734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quote_order (id INT AUTO_INCREMENT NOT NULL, discount_id INT DEFAULT NULL, order_session_id VARCHAR(255) NOT NULL, order_total DOUBLE PRECISION NOT NULL, order_qty INT NOT NULL, updated_date DATE DEFAULT NULL, INDEX IDX_F8D61EF94C7C611F (discount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_order_item (id INT AUTO_INCREMENT NOT NULL, quote_order_id_id INT NOT NULL, book_id_id INT NOT NULL, qty INT NOT NULL, price DOUBLE PRECISION NOT NULL, create_date DATE DEFAULT NULL, INDEX IDX_E2BD65B2A0D9D7D4 (quote_order_id_id), INDEX IDX_E2BD65B271868B2E (book_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quote_order ADD CONSTRAINT FK_F8D61EF94C7C611F FOREIGN KEY (discount_id) REFERENCES coupon_code (id)');
        $this->addSql('ALTER TABLE quote_order_item ADD CONSTRAINT FK_E2BD65B2A0D9D7D4 FOREIGN KEY (quote_order_id_id) REFERENCES quote_order (id)');
        $this->addSql('ALTER TABLE quote_order_item ADD CONSTRAINT FK_E2BD65B271868B2E FOREIGN KEY (book_id_id) REFERENCES books (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quote_order_item DROP FOREIGN KEY FK_E2BD65B2A0D9D7D4');
        $this->addSql('DROP TABLE quote_order');
        $this->addSql('DROP TABLE quote_order_item');
    }
}
