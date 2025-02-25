<?php

namespace App\Entity;

use App\Repository\BancoHorasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BancoHorasRepository::class)]
class BancoHoras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataHoraInicial = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataHoraFinal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomeCliente = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoAtendimento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataHoraInicial(): ?\DateTimeInterface
    {
        return $this->dataHoraInicial;
    }

    public function setDataHoraInicial(\DateTimeInterface $dataHoraInicial): static
    {
        $this->dataHoraInicial = $dataHoraInicial;

        return $this;
    }

    public function getDataHoraFinal(): ?\DateTimeInterface
    {
        return $this->dataHoraFinal;
    }

    public function setDataHoraFinal(\DateTimeInterface $dataHoraFinal): static
    {
        $this->dataHoraFinal = $dataHoraFinal;

        return $this;
    }

    public function getNomeCliente(): ?string
    {
        return $this->nomeCliente;
    }

    public function setNomeCliente(?string $nomeCliente): static
    {
        $this->nomeCliente = $nomeCliente;

        return $this;
    }

    public function getTipoAtendimento(): ?string
    {
        return $this->tipoAtendimento;
    }

    public function setTipoAtendimento(string $tipoAtendimento): static
    {
        $this->tipoAtendimento = $tipoAtendimento;

        return $this;
    }
}
