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
namespace BFOS\FreteBundle\Manager;

use BFOS\FreteBundle\Modalidade\ModalidadeFreteInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BFOS\FreteBundle\Exception\TipoDeObjetoInvalidoException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Form;

class FreteManager {

    protected $modalidades;

    /**
     * @var FormFactoryInterface $container
     */
    protected $formFactory;

    function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function ehValido($modalidade, $dados){

        if(is_string($modalidade) && isset($this->modalidades[$modalidade])){
            $modalidade = $this->modalidades[$modalidade];
        }
        if(!$modalidade instanceof ModalidadeFreteInterface){
            throw new TipoDeObjetoInvalidoException();
        }

        // validar os dados
        $type = $modalidade->getType();
        $form = $this->formFactory->create($type, null, array('csrf_protection'=>false));
        $form->bind($dados);
        if($form->isValid()){

            return true;

        }

        return $this->errostoArray($form);

    }

    public function consultar($modalidade, $dados){

        if(is_string($modalidade) && isset($this->modalidades[$modalidade])){
            $modalidade = $this->modalidades[$modalidade];
        }
        if(!$modalidade instanceof ModalidadeFreteInterface){
            throw new TipoDeObjetoInvalidoException();
        }

        // validar os dados
        $type = $modalidade->getType();
        $form = $this->formFactory->create($type, null, array('csrf_protection'=>false));
        $form->bind($dados);
        if($form->isValid()){

            // preparar a consulta
            return $modalidade->consultar($form->getData());

        }

        return false;

    }

    public function addModalidade(ModalidadeFreteInterface $modalidade){
        if(!isset($this->modalidades[$modalidade->getNome()])){
            $this->modalidades[$modalidade->getNome()] = $modalidade;
        }
    }

    protected function errostoArray(Form $form){
        $result = array();
        if($form->getErrors()){
            $result = array_merge($result,$form->getErrors());
        }
        foreach ( $form as $name => $child ) {
            $r = $this->errostoArray($child);
            if(count($r)){
                $result[$name] = $r;
            }
        }
        return $result;
    }

}
