<?php
/*
 * This file is part of the Duo Criativa's software.
 *
 * (c) Paulo Ribeiro <paulo@duocriativa.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BFOS\FreteBundle\Modalidade;

/**
 * Todas as modalidades de frete devem implementar esta interface.
 *
 * @author Paulo Ribeiro <paulo@duocriativa.com.br>
 */
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormTypeInterface;

interface ModalidadeFreteInterface {

    /**
     * Deve retornar o nome da modalidade de frete.
     * Siga as mesmas regras do getName de um Form Type.
     *
     * @return string O nome da modalidade de frete.
     */
    public function getNome();

    /**
     * Retorna o título da modalidade de frete. O título pode ser exibido ao usuário.
     *
     * @return string O título da modalidade de frete.
     */
    public function getTitulo();

    /**
     * Uma modalidade é responsável por saber quais os parâmetros
     * necessários para o cálculo do frete.
     *
     * O formulário deve ser baseado em uma array, e as validações devem
     * ser feitas no próprio formulário.
     *
     * @return FormTypeInterface
     */
    public function getType();

    /**
     * Deve fazer a consulta do frete e retornar os resultados no formato
     *
     * array(
     *  'prazo_entrega' => 10,
     *  'valor' => 1.99,
     * )
     * @param array $dados para a consulta do frete.
     * @return array
     */
    public function consultar($dados);

}
