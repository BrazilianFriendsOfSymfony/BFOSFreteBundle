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

class AbstractProdutoCorreiosType extends AbstractCorreiosType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        $builder->add('peso', 'text', array( 'required' => true ));

        $formatoChoices = array(
            1 => 'Formato caixa/pacote',
            2 => 'Formato rolo/prisma',
            3 => 'Envelope'
        );
        $builder->add('formato', 'choice', array('choices'=>$formatoChoices, 'required'=>true));

        $builder->add('comprimento', 'number', array('required'=>true));
        $builder->add('largura', 'number', array('required'=>true));
        $builder->add('altura', 'number', array('required'=>true));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $constraints = array(
            'peso'        => array(
                new NotBlank(),
                new Range( array( 'min' => 0 ) )
            ),
            'formato'     => new NotBlank(
                array( 'message' => 'Formato é obrigatório para essa modalidade.' )
            ),
            'comprimento' => new NotBlank(
                array( 'message' => 'Comprimento é obrigatório para essa modalidade.' )
            ),
            'largura'     => new NotBlank(
                array( 'message' => 'Largura é obrigatório para essa modalidade.' )
            ),
            'altura'      => new NotBlank(
                array( 'message' => 'Altura é obrigatório para essa modalidade.' )
            ),
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
        return 'bfos_correios_40010_type';
    }


}
