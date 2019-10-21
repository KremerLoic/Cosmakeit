<?php

declare(strict_types=1);

namespace App\Entity\User;


use App\Entity\Product\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ShopUser as BaseShopUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_shop_user")
 */
class ShopUser extends BaseShopUser
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product\Product", inversedBy="shopUsers")
     */
    private $favorite;

    public function __construct()
    {
        parent::__construct();
        $this->favorite = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Product $favorite): self
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite[] = $favorite;
        }

        return $this;
    }

    public function removeFavorite(Product $favorite): self
    {
        if ($this->favorite->contains($favorite)) {
            $this->favorite->removeElement($favorite);
        }

        return $this;
    }
}
