<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */

class Invoice
{

    public function __construct()
    {
        $this->invoicedate = new \DateTime();
    }

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
    private $MargeBtw;

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
    private $Prijs;

        /**
     * @ORM\Column(type="integer")
     */
    private $kilometerstand;

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

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Klant;

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

    public function getKilometerstand(): ?int
    {
        return $this->kilometerstand;
    }

    public function setKilometerstand(int $kilometerstand): self
    {
        $this->kilometerstand = $kilometerstand;

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

    public function getMargeBtw(): ?string
    {
        return $this->MargeBtw;
    }

    public function setMargeBtw(?string $MargeBtw): self
    {
        $this->MargeBtw = $MargeBtw;

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

    public function getPrijs(): ?string
    {
        return $this->Prijs;
    }

    public function setPrijs(?string $Prijs): self
    {
        $this->Prijs = $Prijs;

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

    public function getKlant(): ?Klant
    {
        return $this->Klant;
    }

    public function setKlant(?Klant $Klant): self
    {
        $this->Klant = $Klant;

        return $this;
    }
}
