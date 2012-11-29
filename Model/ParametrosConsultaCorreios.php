<?php

namespace BFOS\FreteBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ParametrosConsultaCorreios
{

    /**
     * Seu código administrativo junto à ECT. O código está disponível no corpo do contrato firmado com os Correios.
     *
     * @var string $codigoEmpresa
     */
    protected $codigoEmpresa;

    /**
     * Senha para acesso ao serviço, associada ao seu código administrativo. A senha inicial corresponde aos 8 primeiros
     * dígitos do CNPJ informado no contrato. A qualquer momento, é possível alterar a senha no endereço
     * http://www.corporativo.correios.com.br/encomendas/servicosonline/recuperaSenha.
     *
     * @var string $senha
     */
    protected $senha;

    /**
     * O código do serviço é o tipo de serviço que será consultado, por exemplo, 40010 -> SEDEX sem contrato.
     * Pode consultar mais de um tipo de serviço em cada consulta 
     * 
     * @var array $codigoServico
     *
     * @Assert\NotBlank()
     * @Assert\Choice(
     *      choices = { 
     *          "40010", "40045","40126","40215","40290","40096", "40436","40444","40568","40606",
     *          "41106", "41068","81019", "81027", "81035", "81868", "81833", "81850",
     *       },
     *      message = "O valor(es) inserido(s) não é(são) válido(s)"
     * )
     */
    protected $codigoServico;

    /**
     * O cep de origem deve ter o formato: 05311900
     *
     * @var integer $cepOrigem
     *
     * @Assert\NotBlank()
     * @Assert\Max(limit = 8, message = "O cep deve ter exatamente 8 digitos")
     * @Assert\Min(limit = 8, message = "O cep deve ter exatamente 8 digitos")
     */
    protected $cepOrigem;

    /**
     * O cep de destino deve ter o formato: 05311900
     * 
     * @var integer $cepDestino
     *
     * @Assert\NotBlank()
     * @Assert\Max(limit = 8, message = "O cep deve ter exatamente 8 digitos")
     * @Assert\Min(limit = 8, message = "O cep deve ter exatamente 8 digitos")
     */
    protected $cepDestino;

    /**
     * Peso da encomenda, incluindo sua embalagem. O peso deve ser informado em quilogramas. Se o formato for Envelope, o valor máximo permitido será 1 kg.
     * 
     * @var integer $peso
     *
     * @Assert\NotBlank()
     */
    protected $peso;

    /**
     * Formato da encomenda (incluindo embalagem).
     *      Valores possíveis: 1, 2 ou 3
     *              1 – Formato caixa/pacote
     *              2 – Formato rolo/prisma
     *              3 - Envelope
     *
     * @var integer $formato
     *
     * @Assert\NotBlank()
     */
    protected $formato;

    /**
     * Comprimento da encomenda (incluindo embalagem), em centímetros
     *
     * @var decimal $comprimento
     */
    protected $comprimento;

    /**
     * Altura da encomenda (incluindo embalagem), em centímetros. Se o formato for envelope, informar zero (0)
     *
     * @var decimal $altura
     *
     * @Assert\NotBlank()
     */
    protected $altura;

    /**
     * Largura da encomenda (incluindo embalagem), em centímetros.
     *
     * @var decimal $largura
     *
     * @Assert\NotBlank()
     * @Assert\Min(limit="11")
     */
    protected $largura;

    /**
     * Diâmetro da encomenda (incluindo embalagem), em centímetros.
     *
     * @var decimal $diametro
     *
     * @Assert\NotBlank()
     */
    protected $diametro;

    /**
     * Indica se a encomenda será entregue com o serviço adicional mão própria. Valores possíveis: S ou N   (S – Sim, N – Não)
     *
     * @var string $mao_propria
     *
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"S", "N"})
     */
    protected $mao_propria;

    /**
     * Indica se a encomenda será entregue com o serviço adicional valor declarado. Neste campo deve ser apresentado o valor declarado desejado, em Reais.
     * Se não optar pelo serviço informar zero.
     *
     * @var decimal $valor_declarado
     *
     * @Assert\NotBlank()
     */
    protected $valor_declarado;

    /**
     * Indica se a encomenda será entregue com o serviço adicional aviso de recebimento. Valores possíveis: S ou N (S – Sim, N – Não)
     *
     * @var string $aviso_recebimento
     *
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"S", "N"})
     */
    protected $aviso_recebimento;

    /**
     * Indica a forma de retorno da consulta.
     *      XML -> Resultado em XML
     *      Popup -> Resultado em uma janela popup
     *      <URL>  -> Resultado via post em uma página do requisitante
     *
     * @var string $tipo_retorno
     *
     * @Assert\NotBlank()
     * @Assert\Choice(choices={ "XML", "Popup", "<URL>" }, message="Valor do tipo de retorno é inválido.")
     */
    protected $tipo_retorno;

    function __construct()
    {
        $this->codigoEmpresa = '';
        $this->senha = '';
        $this->mao_propria = 'N';
        $this->aviso_recebimento = 'N';
        $this->valor_declarado = 0;
        $this->formato = 1;
        $this->tipo_retorno = 'XML';
        $this->diametro = 0;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAvisoRecebimento($aviso_recebimento)
    {
        $this->aviso_recebimento = $aviso_recebimento;
    }

    public function getAvisoRecebimento()
    {
        return $this->aviso_recebimento;
    }

    public function setCepDestino($cepDestino)
    {
        $this->cepDestino = $cepDestino;
    }

    public function getCepDestino()
    {
        return $this->cepDestino;
    }

    public function setCepOrigem($cepOrigem)
    {
        $this->cepOrigem = $cepOrigem;
    }

    public function getCepOrigem()
    {
        return $this->cepOrigem;
    }

    /**
     * @param array $codigoEmpresa
     */
    public function setCodigoEmpresa(array $codigoEmpresa)
    {
        $this->codigoEmpresa = $codigoEmpresa;
    }

    /**
     * @return
     */
    public function getCodigoEmpresa()
    {
        return $this->codigoEmpresa;
    }

    public function setCodigoServico($codigoServico)
    {
        $this->codigoServico = $codigoServico;
    }

    public function getCodigoServico()
    {
        return $this->codigoServico;
    }

    public function setComprimento($comprimento)
    {

        if($comprimento>=16) {
            $this->comprimento = $comprimento;
        } else {
            $this->comprimento = 16;
        }
    }

    public function getComprimento()
    {
        return $this->comprimento;
    }

    public function setDiametro($diametro)
    {
        $this->diametro = $diametro;
    }

    public function getDiametro()
    {
        return $this->diametro;
    }

    public function setFormato($formato)
    {
        $this->formato = $formato;
    }

    public function getFormato()
    {
        return $this->formato;
    }

    public function setLargura($largura)
    {
        $this->largura = $largura;
    }

    public function getLargura()
    {
        return $this->largura;
    }

    public function setMaoPropria($mao_propria)
    {
        $this->mao_propria = $mao_propria;
    }

    public function getMaoPropria()
    {
        return $this->mao_propria;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setTipoRetorno($tipo_retorno)
    {
        $this->tipo_retorno = $tipo_retorno;
    }

    public function getTipoRetorno()
    {
        return $this->tipo_retorno;
    }

    public function setValorDeclarado($valor_declarado)
    {
        $this->valor_declarado = $valor_declarado;
    }

    public function getValorDeclarado()
    {
        return $this->valor_declarado;
    }

    public function getUrlConsulta()
    {
        $codigoServico = '';
        foreach($this->codigoServico as $i=>$servico){
            $codigoServico .= $servico;
            if($i != count($this->codigoServico)-1){
                $codigoServico .= ',';
            }
        }

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'.
        'nCdEmpresa='. $this->codigoEmpresa.
        '&sDsSenha='. $this->senha.
        '&nCdServico='. $codigoServico.
        '&sCepOrigem='. $this->cepOrigem.
        '&sCepDestino='. $this->cepDestino.
        '&nVlPeso='. str_replace('.', ',', $this->peso).
        '&nCdFormato='. $this->formato.
        '&nVlComprimento='. str_replace('.', ',', $this->comprimento) .
        '&nVlAltura='. str_replace('.', ',', $this->altura) .
        '&nVlLargura='. str_replace('.', ',', $this->largura).
        '&nVlDiametro='. $this->diametro.
        '&sCdMaoPropria='. $this->mao_propria.
        '&nVlValorDeclarado='. $this->valor_declarado.
        '&sCdAvisoRecebimento='. $this->aviso_recebimento.
        '&StrRetorno='. $this->tipo_retorno
        ;

        return $url;
    }
}
