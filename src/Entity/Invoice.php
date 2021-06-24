<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $invoicenumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $streetnumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postcode;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefoonnummer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $license;

    /**
     * @ORM\Column(type="integer")
     */
    private $meldcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Garantie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Afleveringsbeurt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Inruil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Inruilprijs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtotaal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $totaal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opmerking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Inruillicense;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $verkochteauto;

    /**
     * @ORM\Column(type="date")
     */
    private $invoicedate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoicenumber;
    }

    public function setInvoiceNumber(int $invoicenumber): self
    {
        $this->invoicenumber = $invoicenumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?int
    {
        return $this->streetnumber;
    }

    public function setStreetNumber(int $streetnumber): self
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postcode;
    }

    public function setPostCode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getTelefoonnummer(): ?int
    {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(int $telefoonnummer): self
    {
        $this->telefoonnummer = $telefoonnummer;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getMeldcode(): ?int
    {
        return $this->meldcode;
    }

    public function setMeldcode(int $meldcode): self
    {
        $this->meldcode = $meldcode;

        return $this;
    }

    public function getGarantie(): ?string
    {
        return $this->Garantie;
    }

    public function setGarantie(?string $Garantie): self
    {
        $this->Garantie = $Garantie;

        return $this;
    }

    public function getAfleveringsbeurt(): ?string
    {
        return $this->Afleveringsbeurt;
    }

    public function setAfleveringsbeurt(?string $Afleveringsbeurt): self
    {
        $this->Afleveringsbeurt = $Afleveringsbeurt;

        return $this;
    }

    public function getInruil(): ?string
    {
        return $this->Inruil;
    }

    public function setInruil(?string $Inruil): self
    {
        $this->Inruil = $Inruil;

        return $this;
    }

    public function getInruilprijs(): ?string
    {
        return $this->Inruilprijs;
    }

    public function setInruilprijs(?string $Inruilprijs): self
    {
        $this->Inruilprijs = $Inruilprijs;

        return $this;
    }

    public function getSubtotaal(): ?string
    {
        return $this->subtotaal;
    }

    public function setSubtotaal(string $subtotaal): self
    {
        $this->subtotaal = $subtotaal;

        return $this;
    }

    public function getTotaal(): ?string
    {
        return $this->totaal;
    }

    public function setTotaal(string $totaal): self
    {
        $this->totaal = $totaal;

        return $this;
    }

    public function getOpmerking(): ?string
    {
        return $this->opmerking;
    }

    public function setOpmerking(?string $opmerking): self
    {
        $this->opmerking = $opmerking;

        return $this;
    }

    public function getInruillicense(): ?string
    {
        return $this->Inruillicense;
    }

    public function setInruillicense(?string $Inruillicense): self
    {
        $this->Inruillicense = $Inruillicense;

        return $this;
    }

    public function getVerkochteauto(): ?string
    {
        return $this->verkochteauto;
    }

    public function setVerkochteauto(string $verkochteauto): self
    {
        $this->verkochteauto = $verkochteauto;

        return $this;
    }

    public function getInvoicedate(): ?\DateTimeInterface
    {
        return $this->invoicedate;
    }

    public function setInvoicedate(\DateTimeInterface $invoicedate): self
    {
        $this->invoicedate = $invoicedate;

        return $this;
    }
}
