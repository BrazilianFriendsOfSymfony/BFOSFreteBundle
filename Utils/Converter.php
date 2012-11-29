<?php
/**
 * Created by JetBrains PhpStorm.
 * User: duo
 * Date: 2/25/12
 * Time: 3:24 PM
 * To change this template use File | Settings | File Templates.
 */
namespace BFOS\FreteBundle\Utils;

use Symfony\Component\DependencyInjection\SimpleXMLElement;

class Converter
{
    /**
      * Converte o retorno dos Correios em XML para array
      *
      * @param : $xml - Arquivo XML
      */
    public function xmlToArray($xml)
    {
        $array = $this->xml2array($xml, array());

        return $array['cServico'];
    }

    /**
     * Este código pega conteúdo de qualquer arquivo xml e transforma em um array multidimensional.
     *
     * @param $source - Arquivo XML
     * @param $arr    - Array
     * @return mixed
     */
    function xml2array($source, $arr){
        /**
         * @var SimpleXMLElement $xml
         */
        if(!is_object($source)){
            $xml = simplexml_load_string($source);
        } else {
            $xml = $source;
        }
        $iter = 0;
        foreach($xml as $b){
            $a = $b->getName();
            if(!$b->children()){
                $arr[$a] = trim($b[0]);
            }
            else{
                $arr[$a][$iter] = array();
                $arr[$a][$iter] = $this->xml2Array($b, $arr[$a][$iter]);
            }
            $iter++;
        }
        return $arr;
    }
}
