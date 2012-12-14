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

/**
 * 41106 - PAC sem contrato
 */
class Correios41106 extends AbstractCorreiosModalidade {

    protected $formType;

    function __construct($formType)
    {
        $this->formType = $formType;
    }


    /**
     * Deve retornar o nome da modalidade de frete.
     * Siga as mesmas regras do getName de um Form Type.
     *
     * @return string O nome da modalidade de frete.
     */
    public function getNome()
    {
        return 'correios_41106';
    }

    /**
     * Retorna o título da modalidade de frete.
     *
     * @return string O título da modalidade de frete.
     */
    public function getTitulo()
    {
        return 'PAC';
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
        // TODO: Implement consultar() method.
    }


}
