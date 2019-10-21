<?php

declare(strict_types=1);

namespace App\Entity\Taxonomy;

use App\Entity\Customer\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Taxon as BaseTaxon;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_taxon")
 */
class Taxon extends BaseTaxon implements TaxonInterface
{
    protected function createTranslation(): TaxonTranslationInterface
    {
        return new TaxonTranslation();
    }


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Customer\Customer", mappedBy="preference")
     */
    private $customers;


    public function __construct()
    {
        parent::__construct();
        $this->customers = new ArrayCollection();
    }


    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addPreference($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
            $customer->removePreference($this);
        }

        return $this;
    }


}
