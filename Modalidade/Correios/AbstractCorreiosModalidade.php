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

abstract class AbstractCorreiosModalidade implements ModalidadeFreteInterface {

    const FORMATO_CAIXA_PACOTE = 1;
    const FORMATO_ROLO_PRISMA = 2;
    const FORMATO_ENVELOPE = 3;

    protected function  formatarResultadoConsulta($resultado){
        $resultado = reset($resultado);
        $formatado = array();

        $formatado['prazo_entrega'] = $resultado['PrazoEntrega'];
        $formatado['valor'] = $resultado['Valor'];

        $formatado['codigo'] = $resultado['Codigo'];
        $formatado['valor_mao_propria'] = $resultado['ValorMaoPropria'];
        $formatado['valor_aviso_recebimento'] = $resultado['ValorAvisoRecebimento'];
        $formatado['valor_valor_declarado'] = $resultado['ValorValorDeclarado'];
        $formatado['entrega_domiciliar'] = $resultado['EntregaDomiciliar'];
        $formatado['entrega_sabado'] = $resultado['EntregaSabado'];
        return $formatado;
    }
}
