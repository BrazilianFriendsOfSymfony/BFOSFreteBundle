<?php

namespace BFOS\FreteBundle\Correios;

use BFOS\FreteBundle\Utils\Browser;
use BFOS\FreteBundle\Model\ParametrosConsultaCorreios;
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

    public function consultaCorreiosXml(ParametrosConsultaCorreios $params)
    {
        $larguraMin = 16;
        $alturaMin = 16;

        $url = $params->getUrlConsulta();

        $xml = Browser::get($url);
        $converter = new Converter();
        $conteudo = $converter->xmlToArray($xml);

        foreach ( $conteudo as $key => $value ) {
            if(isset($conteudo[$key]['Valor'])){
                $conteudo[$key]['Valor'] = (float) str_replace(',', '.', $conteudo[$key]['Valor']);
            }
            if(isset($conteudo[$key]['ValorMaoPropria'])){
                $conteudo[$key]['ValorMaoPropria'] = (float) str_replace(',', '.', $conteudo[$key]['ValorMaoPropria']);
            }
            if(isset($conteudo[$key]['ValorAvisoRecebimento'])){
                $conteudo[$key]['ValorAvisoRecebimento'] = (float) str_replace(',', '.', $conteudo[$key]['ValorAvisoRecebimento']);
            }
            if(isset($conteudo[$key]['ValorValorDeclarado'])){
                $conteudo[$key]['ValorValorDeclarado'] = (float) str_replace(',', '.', $conteudo[$key]['ValorValorDeclarado']);
            }
            if(isset($conteudo[$key]['PrazoEntrega'])){
                $conteudo[$key]['PrazoEntrega'] = (integer) str_replace(',', '.', $conteudo[$key]['PrazoEntrega']);
            }
        }

        return $conteudo;
    }

    static public $servicoDescricao = array(
        40010 =>'SEDEX sem contrato',
        41106 => 'PAC sem contrato'
    );

    static public $servicoDescricaoPublica = array(
        40010 =>'SEDEX',
        41106 => 'PAC'
    );

    /**
     * @param $codigo
     * @return string
     */
    static public function getServicoDescricao($codigo)
    {
        if(isset(self::$servicoDescricao[(int) $codigo])){
            return self::$servicoDescricao[(int) $codigo];
        }
        return '';
    }

    /**
     * @param $codigo
     * @return string
     */
    static public function getServicoDescricaoPublica($codigo)
    {
        if(isset(self::$servicoDescricaoPublica[(int) $codigo])){
            return self::$servicoDescricaoPublica[(int) $codigo];
        }
        return '';
    }

}