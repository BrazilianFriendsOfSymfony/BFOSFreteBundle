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

namespace BFOS\FreteBundle\Form\Type\Correios;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\FormBuilderInterface;

class AbstractCorreiosType extends AbstractType
{
    protected $constraints;

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->add('cep_origem', 'text', array('required'=>true, 'label' => 'CEP Origem'));
        $builder->add('cep_destino', 'text', array('required'=>true, 'label' => 'CEP Origem'));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $constraints = array(
            'cep_origem'  => new Length( array( "min" => 8, "max" => 8 ) ),
            'cep_destino' => new Length( array( "min" => 8, "max" => 8 ) )
        );
        $collectionConstraint = new Collection( $constraints );

        $this->constraints = $constraints;

        $resolver->setDefaults(array(
                'constraints' => $collectionConstraint
            ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'bfos_correios_40010_type';
    }


}
