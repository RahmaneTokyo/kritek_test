<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410081126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, invoice_date DATE NOT NULL, invoice_number INT NOT NULL, customer_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoicelines (id INT AUTO_INCREMENT NOT NULL, invoice_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, quantity INT NOT NULL, amount NUMERIC(12, 2) DEFAULT NULL, vat_amount NUMERIC(12, 2) DEFAULT NULL, total NUMERIC(12, 2) NOT NULL, INDEX IDX_10E19EE82989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoicelines ADD CONSTRAINT FK_10E19EE82989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoicelines DROP FOREIGN KEY FK_10E19EE82989F1FD');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoicelines');
    }
}
