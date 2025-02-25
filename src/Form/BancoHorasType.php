<?php

namespace App\Form;

use App\Entity\BancoHoras;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BancoHorasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dataHoraInicial', null, [
                'widget' => 'single_text',
            ])
            ->add('dataHoraFinal', null, [
                'widget' => 'single_text',
            ])
            ->add('nomeCliente')
            ->add('tipoAtendimento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BancoHoras::class,
        ]);
    }
}
