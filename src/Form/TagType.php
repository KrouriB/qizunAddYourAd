<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'ads',
                EntityType::class,
                [
                    'class' => Ad::class,
                    'choice_label' => 'id', // Affiche le champ 'id' de l'entité Ad
                    'label' => 'Pub',
                    'multiple' => true,
                    'row_attr' => ['style' => 'display:none;'], // En mode lecture seule
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
