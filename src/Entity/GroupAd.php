<?php

namespace App\Entity;

use App\Repository\GroupAdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupAdRepository::class)]
class GroupAd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $firstAdId = null;

    #[ORM\OneToMany(mappedBy: 'groupAd', targetEntity: Ad::class, orphanRemoval: true)]
    private Collection $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstAdId(): ?int
    {
        return $this->firstAdId;
    }

    public function setFirstAdId(int $firstAdId): static
    {
        $this->firstAdId = $firstAdId;

        return $this;
    }

    /**
     * @return Collection<int, Ad>
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): static
    {
        if (!$this->ads->contains($ad)) {
            $this->ads->add($ad);
            $ad->setGroupAd($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): static
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getGroupAd() === $this) {
                $ad->setGroupAd(null);
            }
        }

        return $this;
    }
}
