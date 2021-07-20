<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlantRepository::class)
 */

class Klant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Straat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Huisnummer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Woonplaats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Postcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Telefoonnummer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="Klant")
     */
    private $invoices;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }

    public function getStraat(): ?string
    {
        return $this->Straat;
    }

    public function setStraat(string $Straat): self
    {
        $this->Straat = $Straat;

        return $this;
    }

    public function getHuisnummer(): ?string
    {
        return $this->Huisnummer;
    }

    public function setHuisnummer(string $Huisnummer): self
    {
        $this->Huisnummer = $Huisnummer;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->Woonplaats;
    }

    public function setWoonplaats(string $Woonplaats): self
    {
        $this->Woonplaats = $Woonplaats;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->Postcode;
    }

    public function setPostcode(string $Postcode): self
    {
        $this->Postcode = $Postcode;

        return $this;
    }

    public function getTelefoonnummer(): ?string
    {
        return $this->Telefoonnummer;
    }

    public function setTelefoonnummer(?string $Telefoonnummer): self
    {
        $this->Telefoonnummer = $Telefoonnummer;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setKlant($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getKlant() === $this) {
                $invoice->setKlant(null);
            }
        }

        return $this;
    }
}
