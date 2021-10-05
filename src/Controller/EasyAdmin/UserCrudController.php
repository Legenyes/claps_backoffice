<?php

namespace App\Controller\EasyAdmin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('User')
            ->setSearchFields(['id', 'email', 'roles', 'firstName', 'lastName'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $email = TextField::new('email');
        $firstName = TextField::new('firstName');
        $lastName = TextField::new('lastName');
        $roles = ChoiceField::new('roles', 'Roles')
            ->allowMultipleChoices()
            ->autocomplete()
            ->setChoices([  'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'SuperAdmin' => 'ROLE_SUPER_ADMIN']
            );
        $id = IntegerField::new('id', 'ID');
        $password = TextField::new('password');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $email, $firstName, $lastName];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $email, $roles, $password, $firstName, $lastName];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$email, $firstName, $lastName, $roles];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$email, $firstName, $lastName, $roles];
        }
    }
}
