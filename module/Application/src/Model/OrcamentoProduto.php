<?php

namespace Application\Model;

use Application\Model\Produto;
use Application\Model\Orcamento;
use Application\Repository\OrcamentoProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * OrcamentosProdutos
 *
 * @ORM\Table(name="orcamentos_produtos", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="FK_Orcamentos_idx", columns={"orcamento_id"}), @ORM\Index(name="FK_Produtos_idx", columns={"produto_id"})})
 * @ORM\Entity(repositoryClass=OrcamentoProdutoRepository::class)
 */
class OrcamentoProduto
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
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

    /**
     * @var Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;

    /**
     * @var Orcamento
     *
     * @ORM\ManyToOne(targetEntity="Orcamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orcamento_id", referencedColumnName="id")
     * })
     */
    private $orcamento;



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
     * @return  int
     */ 
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @param  int  $quantidade
     *
     * @return  self
     */ 
    public function setQuantidade(int $quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get the value of produto
     *
     * @return  Produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @param  Produto  $produto
     *
     * @return  self
     */ 
    public function setProduto(Produto $produto)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get the value of orcamento
     *
     * @return  Orcamento
     */ 
    public function getOrcamento()
    {
        return $this->orcamento;
    }

    /**
     * Set the value of orcamento
     *
     * @param  Orcamento  $orcamento
     *
     * @return  self
     */ 
    public function setOrcamento(Orcamento $orcamento)
    {
        $this->orcamento = $orcamento;

        return $this;
    }

}
