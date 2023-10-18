<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Form\AdType;
use App\Form\TagType;
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
            CollectionField::new('tags')
            ->setFormType(AdType::class), // Use the custom AdType form type
        ];
    }
}
