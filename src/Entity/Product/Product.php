<?php

declare(strict_types=1);

namespace App\Entity\Product;


use App\Entity\Favorite;
use App\Entity\User\ShopUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product")
 */
class Product extends BaseProduct
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User\ShopUser", mappedBy="favorite")
     */
    private $shopUsers;

    public function __construct()
    {
        parent::__construct();
        $this->shopUsers = new ArrayCollection();
    }

    /**
     * @return Collection|ShopUser[]
     */
    public function getShopUsers(): Collection
    {
        return $this->shopUsers;
    }

    public function addShopUser(ShopUser $shopUser): self
    {
        if (!$this->shopUsers->contains($shopUser)) {
            $this->shopUsers[] = $shopUser;
            $shopUser->addFavorite($this);
        }

        return $this;
    }

    public function removeShopUser(ShopUser $shopUser): self
    {
        if ($this->shopUsers->contains($shopUser)) {
            $this->shopUsers->removeElement($shopUser);
            $shopUser->removeFavorite($this);
        }

        return $this;
    }
}
