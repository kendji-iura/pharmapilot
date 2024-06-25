<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\ClienteRepository;

/**
 * Cliente
 *
 * @ORM\Table(name="clientes", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=true)
     */
    private $telefone;

    /**
     * @var bool
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
    private $ativo;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nome
     *
     * @return  string
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param  string  $nome
     *
     * @return  self
     */ 
    public function setNome(string $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of ativo
     *
     * @return  bool
     */ 
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @param  bool  $ativo
     *
     * @return  self
     */ 
    public function setAtivo(bool $ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     *
     * @return  string|null
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @param  string|null  $telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }
}
