<?php

namespace App\Form;

use App\Entity\Pointage;
use App\Entity\User;
use App\Entity\Chantier;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('user',NumberType::class, ['label' => 'Matricule user'])
            ->add('chantier', EntityType::class,['class'=>Chantier::class,
                'choice_label' =>'nom',
                'label'=>'choix du chantier'])
            ->add('date')
            ->add('time1',NumberType::class, ['label' => 'durée en minute'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
        ]);
    }
}
