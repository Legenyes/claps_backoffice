<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostume;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ClothesCostumeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesCostume::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesCostume')
            ->setEntityLabelInPlural('ClothesCostume')
            ->setSearchFields(['id', 'name', 'code', 'description', 'country', 'area', 'city', 'gender'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('code')
            ->add('name')
            ->add('gender')
            ->add('country')
            ->add(EntityFilter::new('sections'));
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $code = TextField::new('code');
        $gender = ChoiceField::new('gender', 'Gender')
            ->allowMultipleChoices()
            ->autocomplete()
            ->setChoices([ 'Male' => 'M', 'Female' => 'F'])
            ->setTemplatePath('admin/field/property_gender.html.twig');
        $sections = AssociationField::new('sections');
        $country = CountryField::new('country');
        $area = TextField::new('area');
        $city = TextField::new('city');
        $description = TextareaField::new('description');
        $season = AssociationField::new('season');
        $clotheOpportunity = AssociationField::new('clotheOpportunity');
        $clothesCostumePieces = AssociationField::new('clothesCostumePieces');
        $id = IdField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$code, $gender, $name, $country];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $code, $description, $country, $area, $city, $gender, $season, $clotheOpportunity, $sections, $clothesCostumePieces];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $code, $gender, $sections, $country, $area, $city, $description, $season, $clotheOpportunity, $clothesCostumePieces];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $code, $gender, $sections, $country, $area, $city, $description, $season, $clotheOpportunity, $clothesCostumePieces];
        }
    }
}
