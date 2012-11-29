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
        $url = $params->getUrlConsulta();

        $xml = Browser::get($url);
        $converter = new Converter();
        $conteudo = $converter->xmlToArray($xml);

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