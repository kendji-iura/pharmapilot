<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\ProdutoRepository;

/**
 * Produto
 *
 * @ORM\Table(name="produtos", uniqueConstraints={@ORM\UniqueConstraint(name="cod_barras_UNIQUE", columns={"cod_barras"}), @ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_produto_categoria_idx", columns={"categoria_id"})})
  * @ORM\Entity(repositoryClass=ProdutoRepository::class)
 */
class Produto
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
     * @ORM\Column(name="cod_barras", type="string", length=45, nullable=false)
     */
    private $codBarras;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="text", length=16777215, nullable=true)
     */
    private $descricao;

    /**
     * @var bool
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
    private $ativo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagem", type="string", length=255, nullable=true)
     */
    private $imagem;

    /**
     * @var \Application\Model\Categoria
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;
        /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var float
     *
     * @ORM\Column(name="margem", type="float", precision=10, scale=0, nullable=false)
     */
    private $margem = '0';



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
     * Get the value of codBarras
     *
     * @return  string
     */ 
    public function getCodBarras()
    {
        return $this->codBarras;
    }

    /**
     * Set the value of codBarras
     *
     * @param  string  $codBarras
     *
     * @return  self
     */ 
    public function setCodBarras(string $codBarras)
    {
        $this->codBarras = $codBarras;

        return $this;
    }

    /**
     * Get the value of descricao
     *
     * @return  string|null
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @param  string|null  $descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

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
     * Get the value of imagem
     *
     * @return  string|null
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @param  string|null  $imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of categoria
     *
     * @return  \Application\Model\Categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @param  \Application\Model\Categoria  $categoria
     *
     * @return  self
     */ 
    public function setCategoria(\Application\Model\Categoria $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of valor
     *
     * @return  float
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @param  float  $valor
     *
     * @return  self
     */ 
    public function setValor(float $valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of margem
     *
     * @return  float
     */ 
    public function getMargem()
    {
        return $this->margem;
    }

    /**
     * Set the value of margem
     *
     * @param  float  $margem
     *
     * @return  self
     */ 
    public function setMargem(float $margem)
    {
        $this->margem = $margem;

        return $this;
    }
}
