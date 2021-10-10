<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Address;
use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MemberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $address = new Address();
        $address->setCountry('BE');

        $member = new Member();
        $member->setAddress($address);

        return $member;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance->getAddress()) {
            $address = new Address();
            $address->setCountry('BE');
            $entityInstance->setAddress($address);
        }

        parent::updateEntity($entityManager, $entityInstance);
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
        return [
            FormField::addPanel('User Details')->setColumns(6),
            IdField::new('id')->onlyOnDetail(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            DateField::new('birthdate'),
            ChoiceField::new('sex', 'Gender')
                ->hideOnIndex()
                ->setChoices([ 'Male' => 'M', 'Female' => 'F']),
            TextField::new('niss')->hideOnIndex(),
            ChoiceField::new('insurer', 'Insurer')
                ->hideOnIndex()
                ->setChoices([
                    'PartenaMut' => 'PARTENA',
                    'Mutualité Solidaris' => 'SOLIDARIS',
                    'Mutualité Chrétienne' => 'MC'
                ]),

            FormField::addPanel('Contact information')->collapsible(),
            EmailField::new('email'),
            TelephoneField::new('phone'),
            TelephoneField::new('mobilePhone'),

            FormField::addPanel('User Address')->collapsible(),
            TextField::new('address.street')->hideOnIndex(),
            TextField::new('address.streetNumber')->hideOnIndex(),
            TextField::new('address.streetBox')->hideOnIndex(),
            TextField::new('address.zipCode')->hideOnIndex(),
            TextField::new('address.city')->hideOnIndex(),
            CountryField::new('address.country')->hideOnIndex(),
        ];
    }
}
