<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Form\TagType;
use App\Repository\AdRepository;
use App\Repository\TagRepository;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ad::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setFormTypeOption('disabled', 'disabled'),
            ChoiceField::new('weight')->setChoices([
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
            ])->renderExpanded(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->OnlyonForms(),
            ImageField::new('image')->setBasePath('/img/uploads')->hideOnForm(),
            TextField::new('link'),
            DateField::new('startedAt'),
            DateField::new('endedAt'),
            IntegerField::new('views')->setFormTypeOption('disabled', 'disabled'),
            // CollectionField::new('tags')
            //     ->onlyOnForms()
            //     ->setEntryIsComplex(true) // Indique que chaque entrée est complexe (Module + nombre de jours)
            //     ->setFormTypeOptions(
            //         [
            //         'allow_add' => true, // Autoriser l'ajout de nouvelles entrées
            //         'allow_delete' => true, // Autoriser la suppression d'entrées existantes
            //         'by_reference' => false, // Nécessaire pour que les modifications soient persistées correctement
            //         ]
            //     )
            //     ->setEntryType(TagType::class) // Le formulaire pour chaque entrée
            //     ->setCustomOption('query_builder', function (TagRepository $tagRepository) {
            //         return $tagRepository->createQueryBuilder('t')
            //             ->orderBy('t.name', 'ASC');
            //     })
            AssociationField::new('tags')
                ->setFormTypeOptions(
                    [
                    'by_reference' => false,
                    ]
                ),
        ];
    }

    

    public function tagAds(
        AdRepository $adRepository,
        TagRepository $tagRepository,
    )
    {
        $ad = $adRepository->find('id');
        $notTagged = $tagRepository->findNotTagged('id');
        $tagged = $tagRepository->findTagged('id');
    }

    public function setTagToAds( // potentiellement inutille
        AdRepository $adRepository,
        TagRepository $tagRepository,
        EntityManagerInterface $entityManager
    )
    {
        $ad = $adRepository->find('id');
        
    }
}
