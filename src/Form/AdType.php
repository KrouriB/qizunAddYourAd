<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ... other fields for Ad entity ...

            // Add a field to select existing Tags
            ->add('tags', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => 'App\Entity\Tag',
                ],
                'by_reference' => false,
                'label' => 'Tags',
                'required' => false,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}