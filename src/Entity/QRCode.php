<?php

namespace App\Entity;

use App\Repository\QRCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QRcodeRepository::class)]
class QRCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nome = null;

    #[ORM\Column(length: 255)]
    private ?string $Tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $Conteudo = null;

    #[ORM\Column(length: 255)]
    private ?string $Acao = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->Nome;
    }

    public function setNome(string $Nome): static
    {
        $this->Nome = $Nome;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(string $Tipo): static
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getConteudo(): ?string
    {
        return $this->Conteudo;
    }

    public function setConteudo(string $Conteudo): static
    {
        $this->Conteudo = $Conteudo;

        return $this;
    }

    public function getAcao(): ?string
    {
        return $this->Acao;
    }

    public function setAcao(string $Acao): static
    {
        $this->Acao = $Acao;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(?bool $Status): static
    {
        $this->Status = $Status;

        return $this;
    }
}
