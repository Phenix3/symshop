<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608063631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', country_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', is_professionnal TINYINT(1) NOT NULL, civility VARCHAR(10) NOT NULL, name VARCHAR(100) DEFAULT NULL, first_name VARCHAR(100) DEFAULT NULL, company VARCHAR(100) DEFAULT NULL, address VARCHAR(255) NOT NULL, addressbis VARCHAR(255) DEFAULT NULL, bp VARCHAR(100) DEFAULT NULL, postal VARCHAR(10) NOT NULL, city VARCHAR(100) NOT NULL, phone VARCHAR(25) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D4E6F81F92F3E70 (country_id), INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', file_name VARCHAR(255) NOT NULL, file_size INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', tree_root CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), INDEX IDX_64C19C1A977936C (tree_root), INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product (category_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_149244D312469DE2 (category_id), INDEX IDX_149244D34584665A (product_id), PRIMARY KEY(category_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colissimo (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', country_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', range_value_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', price DOUBLE PRECISION NOT NULL, INDEX IDX_64616F3AF92F3E70 (country_id), INDEX IDX_64616F3AB7741401 (range_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', range_value_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, tax DOUBLE PRECISION NOT NULL, INDEX IDX_5373C966B7741401 (range_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gateway_config (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', gateway_name VARCHAR(255) NOT NULL, factory_name VARCHAR(255) NOT NULL, config JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', state_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', billing_address_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', shipping_address_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', reference VARCHAR(255) NOT NULL, shipping DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION NOT NULL, tax DOUBLE PRECISION DEFAULT NULL, purchase_order VARCHAR(100) DEFAULT NULL, pick TINYINT(1) DEFAULT \'0\', notes LONGTEXT DEFAULT NULL, checkout_completed_at DATETIME DEFAULT NULL, checkout_state VARCHAR(255) DEFAULT \'cart\' NOT NULL, token_value VARCHAR(255) DEFAULT NULL, payment_state VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F52993985D83CC1 (state_id), UNIQUE INDEX UNIQ_F529939879D0C0E4 (billing_address_id), UNIQUE INDEX UNIQ_F52993984D4CFF2B (shipping_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', order_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', product_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, total_price_gross DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', method_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', order_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', number VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, client_email VARCHAR(255) DEFAULT NULL, client_id VARCHAR(255) DEFAULT NULL, total_amount INT DEFAULT NULL, currency_code VARCHAR(255) DEFAULT NULL, details JSON NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_6D28840D19883967 (method_id), INDEX IDX_6D28840D8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', gateway_config_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, instructions LONGTEXT NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_7B61A1F6F23D6140 (gateway_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_token (hash VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', after_url LONGTEXT DEFAULT NULL, target_url LONGTEXT NOT NULL, gateway_name VARCHAR(255) NOT NULL, PRIMARY KEY(hash)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, is_active TINYINT(1) NOT NULL, quantity INT DEFAULT 0 NOT NULL, quantity_alert INT DEFAULT 10 NOT NULL, description LONGTEXT NOT NULL, meta_keywords LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D34A04AD5E237E06 (name), UNIQUE INDEX UNIQ_D34A04AD989D9B62 (slug), INDEX IDX_D34A04AD3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attachment (product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', attachment_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_EA3886904584665A (product_id), UNIQUE INDEX UNIQ_EA388690464E68B (attachment_id), PRIMARY KEY(product_id, attachment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE range_value (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', max DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', author_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', rating INT NOT NULL, comment LONGTEXT NOT NULL, status VARCHAR(20) DEFAULT \'PENDING\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_794381C64584665A (product_id), INDEX IDX_794381C6F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', key_name VARCHAR(255) NOT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, holder VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, bank VARCHAR(255) NOT NULL, bank_address VARCHAR(255) NOT NULL, phone VARCHAR(25) NOT NULL, facebook VARCHAR(255) NOT NULL, home VARCHAR(255) NOT NULL, home_infos LONGTEXT NOT NULL, home_shipping LONGTEXT NOT NULL, has_invoice TINYINT(1) DEFAULT \'1\' NOT NULL, has_card TINYINT(1) DEFAULT \'1\' NOT NULL, has_transfer TINYINT(1) DEFAULT \'1\' NOT NULL, has_check TINYINT(1) DEFAULT \'1\' NOT NULL, has_mandat TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, slug VARCHAR(50) NOT NULL, color VARCHAR(20) NOT NULL, indice INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, newsletter TINYINT(1) DEFAULT NULL, last_seen DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A977936C FOREIGN KEY (tree_root) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product ADD CONSTRAINT FK_149244D312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product ADD CONSTRAINT FK_149244D34584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE colissimo ADD CONSTRAINT FK_64616F3AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE colissimo ADD CONSTRAINT FK_64616F3AB7741401 FOREIGN KEY (range_value_id) REFERENCES range_value (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966B7741401 FOREIGN KEY (range_value_id) REFERENCES range_value (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939879D0C0E4 FOREIGN KEY (billing_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984D4CFF2B FOREIGN KEY (shipping_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D19883967 FOREIGN KEY (method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE payment_method ADD CONSTRAINT FK_7B61A1F6F23D6140 FOREIGN KEY (gateway_config_id) REFERENCES gateway_config (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD3DA5256D FOREIGN KEY (image_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE product_attachment ADD CONSTRAINT FK_EA3886904584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_attachment ADD CONSTRAINT FK_EA388690464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES attachment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939879D0C0E4');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984D4CFF2B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD3DA5256D');
        $this->addSql('ALTER TABLE product_attachment DROP FOREIGN KEY FK_EA388690464E68B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A977936C');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category_product DROP FOREIGN KEY FK_149244D312469DE2');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81F92F3E70');
        $this->addSql('ALTER TABLE colissimo DROP FOREIGN KEY FK_64616F3AF92F3E70');
        $this->addSql('ALTER TABLE payment_method DROP FOREIGN KEY FK_7B61A1F6F23D6140');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D8D9F6D38');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D19883967');
        $this->addSql('ALTER TABLE category_product DROP FOREIGN KEY FK_149244D34584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE product_attachment DROP FOREIGN KEY FK_EA3886904584665A');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C64584665A');
        $this->addSql('ALTER TABLE colissimo DROP FOREIGN KEY FK_64616F3AB7741401');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966B7741401');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993985D83CC1');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_product');
        $this->addSql('DROP TABLE colissimo');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE gateway_config');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE payment_token');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_attachment');
        $this->addSql('DROP TABLE range_value');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
