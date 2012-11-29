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

    /**
     * @return \BFOS\FreteBundle\Model\ParametrosConsultaCorreios
     */
    static public function getParametrosConsultaCorreios()
    {
        return new ParametrosConsultaCorreios();
    }
}