<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\LoteRepository;

/**
 * Lote
 *
 * @ORM\Table(name="lotes", uniqueConstraints={@ORM\UniqueConstraint(name="produto_filial_lote_UNIQUE", columns={"produto_id", "filial_id", "lote"}), @ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="filial_FK_idx", columns={"filial_id"}), @ORM\Index(name="IDX_7BDBF5EC105CFD56", columns={"produto_id"})})
 * @ORM\Entity(repositoryClass=LoteRepository::class)
 */
class Lote
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
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="lote", type="string", length=100, nullable=false)
     */
    private $lote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validade", type="date", nullable=false)
     */
    private $validade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entrada", type="date", nullable=false)
     */
    private $entrada;



    /**
     * @var \Application\Model\Filial
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Filial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="filial_id", referencedColumnName="id")
     * })
     */
    private $filial;

    /**
     * @var \Application\Model\Produto
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;



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
     * Get the value of quantidade
     *
     * @return  float
     */ 
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @param  float  $quantidade
     *
     * @return  self
     */ 
    public function setQuantidade(float $quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get the value of lote
     *
     * @return  string
     */ 
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * Set the value of lote
     *
     * @param  string  $lote
     *
     * @return  self
     */ 
    public function setLote(string $lote)
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * Get the value of validade
     *
     * @return  \DateTime
     */ 
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * Set the value of validade
     *
     * @param  \DateTime  $validade
     *
     * @return  self
     */ 
    public function setValidade(\DateTime $validade)
    {
        $this->validade = $validade;

        return $this;
    }

    /**
     * Get the value of entrada
     *
     * @return  \DateTime
     */ 
    public function getEntrada()
    {
        return $this->entrada;
    }

    /**
     * Set the value of entrada
     *
     * @param  \DateTime  $entrada
     *
     * @return  self
     */ 
    public function setEntrada(\DateTime $entrada)
    {
        $this->entrada = $entrada;

        return $this;
    }

    /**
     * Get the value of filial
     *
     * @return  \Application\Model\Filial
     */ 
    public function getFilial()
    {
        return $this->filial;
    }

    /**
     * Set the value of filial
     *
     * @param  \Application\Model\Filial  $filial
     *
     * @return  self
     */ 
    public function setFilial(\Application\Model\Filial $filial)
    {
        $this->filial = $filial;

        return $this;
    }

    /**
     * Get the value of produto
     *
     * @return  \Application\Model\Produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @param  \Application\Model\Produto  $produto
     *
     * @return  self
     */ 
    public function setProduto(\Application\Model\Produto $produto)
    {
        $this->produto = $produto;

        return $this;
    }
}
