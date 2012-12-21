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
use Symfony\Component\Validator\Constraints\Min;
use Symfony\Component\Validator\Constraints\Range;


class Correios40045Type extends AbstractProdutoCorreiosType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        $builder->add('valor_declarado', 'money', array('currency'=>'BRL', 'required'=>true));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $constraints = array(
            'valor_declarado'  => array(
                new NotBlank(
                    array( 'message' => 'Valor declarado é obrigatório para essa modalidade.' )
                ),
                new Range(
                    array( 'min' => 12, 'minMessage' => 'O valor declarado não pode ser inferior a R$ 12,00')
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
        return 'bfos_correios_40045_type';
    }


}
