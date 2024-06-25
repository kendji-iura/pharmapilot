<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Application\Model\UsuarioRepository;

/**
 * Usuario
 *
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})

 * @ORM\Entity
 */
class Usuario
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
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=false)
     */
    private $tipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false, options={"default"="1"})
     */
    private $ativo = true;



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
     * Get the value of senha
     *
     * @return  string
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @param  string  $senha
     *
     * @return  self
     */ 
    public function setSenha(string $senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of tipo
     *
     * @return  string
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @param  string  $tipo
     *
     * @return  self
     */ 
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;

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
}
