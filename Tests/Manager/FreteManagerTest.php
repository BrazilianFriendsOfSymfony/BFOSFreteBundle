<?php

namespace BFOS\FreteBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use BFOS\FreteBundle\Manager\FreteManager;
use BFOS\FreteBundle\Modalidade\Correios\AbstractCorreiosModalidade;
use BFOS\FreteBundle\Exception\TipoDeObjetoInvalidoException;

class FreteManagerTest extends WebTestCase
{
    public function testConsultar()
    {
        $client = static::createClient();

        /**
         * @var FreteManager $freteManager
         */
        $freteManager = static::$kernel->getContainer()->get('bfos_frete.manager');

        $dados = array(
            'cep_origem' => '13084012'
            , 'cep_destino' => '14402412'
            , 'peso' => 1
            , 'largura' => 20
            , 'comprimento' => 20
            , 'altura' => 20
            , 'formato' => AbstractCorreiosModalidade::FORMATO_CAIXA_PACOTE
        );

        try {
            $freteManager->consultar(new \Exception(), array());
            $this->assertTrue(false, 'Não está disparando a exceção que devia.');
        } catch (\Exception $e) {
            $this->assertInstanceOf('BFOS\FreteBundle\Exception\TipoDeObjetoInvalidoException', $e);
        }

        $resultado = $freteManager->consultar('correios_40010', $dados);

        $this->assertTrue(is_array($resultado), 'O resultado da consulta é uma array.');

        $this->assertArrayHasKey('valor', $resultado, 'Parâmetro valor está definido.');
        $this->assertTrue(isset($resultado['valor']) && is_float($resultado['valor']), 'Parâmetro valor é float.');

        $this->assertArrayHasKey('prazo_entrega', $resultado, 'Parâmetro prazo_entrega está definido.');
        $this->assertTrue(
            isset($resultado['prazo_entrega']) && is_integer($resultado['prazo_entrega']),
            'Parâmetro prazo_entrega é inteiro.'
        );

        $resultado = $freteManager->consultar('correios_40010', array('cep_origem' => '13084012'));
        $this->assertTrue($resultado===false, 'Com parâmetros insuficientes, deveria retornar false.');

    }
}
