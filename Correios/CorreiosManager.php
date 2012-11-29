<?php

namespace BFOS\FreteBundle\Correios;

use BFOS\FreteBundle\Utils\Browser;
use BFOS\FreteBundle\Utils\Converter;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CorreiosManager
{
    private $container;

    private $em;


    function __construct(ContainerInterface $container)
    {
        $this->container  = $container;
        $this->em         = $container->get('doctrine')->getEntityManager();
        $this->logger     = $container->get('logger');
    }

    public function consultaCorreiosXml(array $options)
    {

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'.
            'nCdEmpresa='. $options['codigo_empresa'].
            '&sDsSenha='. $options['senha'].
            '&nCdServico='. $options['codigo_servico'].
            '&sCepOrigem='. $options['cep_origem'].
            '&sCepDestino='. $options['cep_destino'].
            '&nVlPeso='. $options['peso'].
            '&nCdFormato='. $options['formato'].
            '&nVlComprimento='. $options['comprimento'].
            '&nVlAltura='. $options['altura'].
            '&nVlLargura='. $options['largura'].
            '&nVlDiametro='. $options['diametro'].
            '&sCdMaoPropria='. $options['mao_propria'].
            '&nVlValorDeclarado='. $options['valor_declarado'].
            '&sCdAvisoRecebimento='. $options['aviso_recebimento'].
            '&StrRetorno='. $options['tipo_retorno']
            ;

        $xml = Browser::get($url);
        $converter = new Converter();
        $conteudo = $converter->xmlToArray($xml);

        return $conteudo;
    }
}