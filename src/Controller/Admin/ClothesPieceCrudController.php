<?php

namespace App\Controller\Admin;

use App\Entity\ClothesPiece;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ClothesPieceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClothesPiece::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ClothesPiece')
            ->setEntityLabelInPlural('ClothesPiece')
            ->setSearchFields(['id', 'name', 'code', 'description', 'country', 'area', 'city', 'gender', 'image'])
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
        $gender = ArrayField::new('gender')->setTemplatePath('easy_admin/property_gender.html.twig');
        $personal = Field::new('personal');
        $sections = AssociationField::new('sections');
        $country = TextField::new('country')->setTemplatePath('easy_admin/property_country.html.twig');
        $area = TextField::new('area');
        $city = TextField::new('city');
        $description = TextField::new('description');
        $clotheType = AssociationField::new('clotheType');
        $clotheTexture = AssociationField::new('clotheTexture');
        $clotheOpportunity = AssociationField::new('clotheOpportunity');
        $imageFile = Field::new('imageFile');
        $clothesPieceStocks = AssociationField::new('clothesPieceStocks');
        $id = IntegerField::new('id', 'ID');
        $image = ImageField::new('image');
        $updatedAt = DateTimeField::new('updatedAt');
        $season = AssociationField::new('season');
        $clothesCostumePieces = AssociationField::new('clothesCostumePieces');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $image, $code, $gender, $name, $country, $clothesPieceStocks];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $code, $description, $country, $area, $city, $personal, $gender, $image, $updatedAt, $season, $clotheType, $clotheTexture, $clotheOpportunity, $sections, $clothesCostumePieces, $clothesPieceStocks];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $code, $gender, $personal, $sections, $country, $area, $city, $description, $clotheType, $clotheTexture, $clotheOpportunity, $imageFile, $clothesPieceStocks];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $code, $gender, $personal, $sections, $country, $area, $city, $description, $clotheType, $clotheTexture, $clotheOpportunity, $imageFile, $clothesPieceStocks];
        }
    }
}
