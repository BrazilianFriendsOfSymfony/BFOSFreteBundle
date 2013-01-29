<?php
 /*
 * This file is part of the Duo Criativa software.
 * Este arquivo é parte do software da Duo Criativa.
 *
 * (c) Paulo Ribeiro <paulo@duocriativa.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BFOS\FreteBundle\Modalidade\Correios;

use BFOS\FreteBundle\Modalidade\ModalidadeFreteInterface;
use Symfony\Component\Form\FormTypeInterface;
use BFOS\FreteBundle\Correios\CorreiosManager;
use BFOS\FreteBundle\Model\ParametrosConsultaCorreios;
use BFOS\FreteBundle\Exception\ConsultaCorreiosInvalidaException;

/**
 * 81833 - (Grupo 2) e-SEDEX, com contrato
 */
class Correios81833 extends AbstractCorreiosModalidade {

    protected $formType;

    protected $correiosManager;

    function __construct($formType, CorreiosManager $correiosManager)
    {
        $this->formType = $formType;
        $this->correiosManager = $correiosManager;
    }

    /**
     * Deve retornar o nome da modalidade de frete.
     * Siga as mesmas regras do getName de um Form Type.
     *
     * @return string O nome da modalidade de frete.
     */
    public function getNome()
    {
        return 'correios_81833';
    }

    /**
     * Retorna o título da modalidade de frete.
     *
     * @return string O título da modalidade de frete.
     */
    public function getTitulo()
    {
        return 'e-Sedex';
    }

    /**
     * Uma modalidade é responsável por saber quais os parâmetros
     * necessários para o cálculo do frete.
     *
     * O formulário deve ser baseado em uma array, e as validações devem
     * ser feitas no próprio formulário.
     *
     * @return FormTypeInterface
     */
    public function getType()
    {
        $class = $this->formType;
        return new $class();
    }

    /**
     * Deve fazer a consulta do frete e retornar os resultados no formato
     *
     * array(
     *  'prazo_entrega' => 10,
     *  'valor' => 1.99,
     * )
     * @param $dados Dados para a consulta do frete.
     * @return array
     */
    public function consultar( $dados )
    {
        $params = new ParametrosConsultaCorreios();
        $params->setCodigoEmpresa(isset($dados['codigo_empresa'])?$dados['codigo_empresa']:null);
        $params->setSenha(isset($dados['senha'])?$dados['senha']:null);
        $params->setPeso(isset($dados['peso'])?$dados['peso']:null);
        $params->setFormato(isset($dados['formato'])?$dados['formato']:null);
        $params->setAltura(isset($dados['altura'])?$dados['altura']:null);
        $params->setLargura(isset($dados['largura'])?$dados['largura']:null);
        $params->setComprimento(isset($dados['comprimento'])?$dados['comprimento']:null);
        $params->setCepOrigem(isset($dados['cep_origem'])?$dados['cep_origem']:null);
        $params->setCepDestino(isset($dados['cep_destino'])?$dados['cep_destino']:null);
        $params->setCodigoServico(array('81868'));
        $resultadoCorreios = $this->correiosManager->consultaCorreiosXml( $params );
        if(isset($resultadoCorreios[0]['Erro']) && $resultadoCorreios[0]['Erro']){
            throw new ConsultaCorreiosInvalidaException(isset($resultadoCorreios[0]['MsgErro'])?$resultadoCorreios[0]['MsgErro']:'', $resultadoCorreios[0]['Erro']);
        }
        return $this->formatarResultadoConsulta( $resultadoCorreios );
    }


}
