<?php

declare(strict_types=1);

namespace App\Controller\EasyAdmin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            ->setEntityLabelInPlural('Users')
            ->setSearchFields(['id', 'email', 'roles', 'firstName', 'lastName'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnDetail(),
            EmailField::new('email'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('password')->onlyOnForms(),
            ChoiceField::new('roles', 'Roles')
                ->allowMultipleChoices()
                ->autocomplete()
                ->setChoices([
                    'User' => 'ROLE_USER',
                        'Admin' => 'ROLE_ADMIN',
                        'SuperAdmin' => 'ROLE_SUPER_ADMIN'
                    ])
        ];
    }
}
