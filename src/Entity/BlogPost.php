<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    #[ORM\Id]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private ?Ulid $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Content = null;

    #[ORM\ManyToMany(targetEntity: BlogCategories::class, inversedBy: 'blogPosts')]
    private Collection $BlogCategory;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'blogPosts')]
    private Collection $BlogTags;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    public function __construct()
    {
        $this->BlogCategory = new ArrayCollection();
        $this->BlogTags = new ArrayCollection();
    }

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    /**
     * @return Collection<int, BlogCategories>
     */
    public function getBlogCategory(): Collection
    {
        return $this->BlogCategory;
    }

    public function addBlogCategory(BlogCategories $blogCategory): self
    {
        if (!$this->BlogCategory->contains($blogCategory)) {
            $this->BlogCategory->add($blogCategory);
        }

        return $this;
    }

    public function removeBlogCategory(BlogCategories $blogCategory): self
    {
        $this->BlogCategory->removeElement($blogCategory);

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getBlogTags(): Collection
    {
        return $this->BlogTags;
    }

    public function addBlogTag(Tags $blogTag): self
    {
        if (!$this->BlogTags->contains($blogTag)) {
            $this->BlogTags->add($blogTag);
        }

        return $this;
    }

    public function removeBlogTag(Tags $blogTag): self
    {
        $this->BlogTags->removeElement($blogTag);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }
}