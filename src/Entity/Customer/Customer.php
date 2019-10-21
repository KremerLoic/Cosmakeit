<?php

declare(strict_types=1);

namespace App\Entity\Customer;

use App\Entity\Product\Product;
use App\Entity\Taxonomy\Taxon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Customer as BaseCustomer;
use Sylius\Component\Core\Model\CustomerInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_customer")
 */
class Customer extends BaseCustomer implements CustomerInterface
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Taxonomy\Taxon", inversedBy="customers")
     */
    private $preference;


    public function __construct()
    {
        parent::__construct();
        $this->preference = new ArrayCollection();

    }
    /**
     * @return Collection|Taxon[]
     */
    public function getPreference(): Collection
    {
        return $this->preference;
    }

    public function addPreference(Taxon $preference): self
    {
        if (!$this->preference->contains($preference)) {
            $this->preference[] = $preference;
        }

        return $this;
    }

    public function removePreference(Taxon $preference): self
    {
        if ($this->preference->contains($preference)) {
            $this->preference->removeElement($preference);
        }

        return $this;
    }


}
