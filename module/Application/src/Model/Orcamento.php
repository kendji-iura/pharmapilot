<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Application\Repository\OrcamentoRepository;

/**
 * Orcamento
 *
 * @ORM\Table(name="orcamentos", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_orcamento_filial_idx", columns={"filial_id"}), @ORM\Index(name="fk_orcamento_usuario_idx", columns={"usuario_id"}), @ORM\Index(name="fk_orcamento_cliente_idx", columns={"cliente_id"})})
 * @ORM\Entity(repositoryClass=OrcamentoRepository::class)
 */
class Orcamento
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="acrescimo", type="float", precision=10, scale=0, nullable=true)
     */
    private $acrescimo = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="desconto", type="float", precision=10, scale=0, nullable=true)
     */
    private $desconto = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacao", type="string", length=45, nullable=true)
     */
    private $observacao;

    /**
     * @var \Application\Model\Cliente
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

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
     * @var \Application\Model\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Application\Model\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



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
     * Get the value of data
     *
     * @return  string
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @param  \DateTime  $data
     *
     * @return  self
     */ 
    public function setData(\DateTime $data)
    {
        $this->data = $data;

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
     * Get the value of acrescimo
     *
     * @return  float|null
     */ 
    public function getAcrescimo()
    {
        return $this->acrescimo;
    }

    /**
     * Set the value of acrescimo
     *
     * @param  float|null  $acrescimo
     *
     * @return  self
     */ 
    public function setAcrescimo($acrescimo)
    {
        $this->acrescimo = $acrescimo;

        return $this;
    }

    /**
     * Get the value of desconto
     *
     * @return  float|null
     */ 
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * Set the value of desconto
     *
     * @param  float|null  $desconto
     *
     * @return  self
     */ 
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  string
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of observacao
     *
     * @return  string|null
     */ 
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set the value of observacao
     *
     * @param  string|null  $observacao
     *
     * @return  self
     */ 
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get the value of cliente
     *
     * @return  \Application\Model\Cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @param  \Application\Model\Cliente  $cliente
     *
     * @return  self
     */ 
    public function setCliente(\Application\Model\Cliente $cliente)
    {
        $this->cliente = $cliente;

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
     * Get the value of usuario
     *
     * @return  \Application\Model\Usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @param  \Application\Model\Usuario  $usuario
     *
     * @return  self
     */ 
    public function setUsuario(\Application\Model\Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}
