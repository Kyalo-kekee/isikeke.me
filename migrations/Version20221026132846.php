<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026132846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_categories (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', category_name VARCHAR(100) NOT NULL, category_description VARCHAR(255) DEFAULT NULL, category_image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_blog_categories (blog_post_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', blog_categories_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_2A4AF5EAA77FBEAF (blog_post_id), INDEX IDX_2A4AF5EAD194DEDB (blog_categories_id), PRIMARY KEY(blog_post_id, blog_categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post_tags (blog_post_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', tags_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_3971B62A77FBEAF (blog_post_id), INDEX IDX_3971B628D7B4FB4 (tags_id), PRIMARY KEY(blog_post_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(32) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_post_blog_categories ADD CONSTRAINT FK_2A4AF5EAA77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_blog_categories ADD CONSTRAINT FK_2A4AF5EAD194DEDB FOREIGN KEY (blog_categories_id) REFERENCES blog_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_tags ADD CONSTRAINT FK_3971B62A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_post_tags ADD CONSTRAINT FK_3971B628D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post_blog_categories DROP FOREIGN KEY FK_2A4AF5EAA77FBEAF');
        $this->addSql('ALTER TABLE blog_post_blog_categories DROP FOREIGN KEY FK_2A4AF5EAD194DEDB');
        $this->addSql('ALTER TABLE blog_post_tags DROP FOREIGN KEY FK_3971B62A77FBEAF');
        $this->addSql('ALTER TABLE blog_post_tags DROP FOREIGN KEY FK_3971B628D7B4FB4');
        $this->addSql('DROP TABLE blog_categories');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE blog_post_blog_categories');
        $this->addSql('DROP TABLE blog_post_tags');
        $this->addSql('DROP TABLE tags');
    }
}
