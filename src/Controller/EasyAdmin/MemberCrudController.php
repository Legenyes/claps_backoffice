<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Member')
            ->setEntityLabelInPlural('Member')
            ->setSearchFields(['id', 'firstname', 'lastname', 'email', 'phone', 'mobilePhone', 'sex', 'niss', 'insurer'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $firstname = TextField::new('firstname');
        $lastname = TextField::new('lastname');
        $email = TextField::new('email');
        $phone = TextField::new('phone');
        $mobilePhone = TextField::new('mobilePhone');
        $sex = TextField::new('sex');
        $birthdate = DateField::new('birthdate');
        $niss = TextField::new('niss');
        $insurer = TextField::new('insurer');
        $address = AssociationField::new('address');
        $memberShips = AssociationField::new('memberShips');
        $id = IntegerField::new('id', 'ID');
        $clothesPieceStitched = AssociationField::new('clothesPieceStitched');
        $clothesPieces = AssociationField::new('clothesPieces');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $firstname, $lastname, $email, $phone, $mobilePhone, $birthdate];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $firstname, $lastname, $email, $phone, $mobilePhone, $birthdate, $sex, $niss, $insurer, $address, $memberShips, $clothesPieceStitched, $clothesPieces];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$firstname, $lastname, $email, $phone, $mobilePhone, $sex, $birthdate, $niss, $insurer, $address, $memberShips];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$firstname, $lastname, $email, $phone, $mobilePhone, $sex, $birthdate, $niss, $insurer, $address, $memberShips];
        }
    }
}
