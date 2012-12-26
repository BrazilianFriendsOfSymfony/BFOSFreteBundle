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
use Symfony\Component\Validator\Constraints\NotBlank;


class Correios40096Type extends AbstractProdutoCorreiosType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        $builder->add('codigo_empresa', 'text', array('required'=>true));
        $builder->add('senha', 'text', array('required'=>true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $constraints = array(
            'codigo_empresa'  => array(
                new NotBlank(
                    array( 'message' => 'Código da empresa é obrigatório para essa modalidade.' )
                )
            ),
            'senha'  => array(
                new NotBlank(
                    array( 'message' => 'Senha é obrigatória para essa modalidade.' )
                )
            )
        );

        $constraints = array_merge($this->constraints, $constraints);
        $this->constraints = $constraints;
        $collectionConstraint = new Collection( $constraints );
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
        return 'bfos_correios_40096_type';
    }


}
