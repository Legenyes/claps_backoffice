<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use Infra\Symfony\Persistance\Doctrine\Entity\Address;
use Infra\Symfony\Persistance\Doctrine\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Infra\Symfony\Persistance\Doctrine\Entity\MemberShip;
use Infra\Symfony\Service\CsvService;
use Symfony\Component\HttpFoundation\Request;

class MemberCrudController extends AbstractCrudController
{
    public function __construct(private CsvService $csvService, private EntityManagerInterface $entityManager)
    {
    }
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

    public function configureActions(Actions $actions): Actions
    {
        $export = Action::new('export', 'action.export')
            ->setIcon('fa fa-download')
            ->linkToCrudAction('export')
            ->setCssClass('btn')
            ->createAsGlobalAction();

        return $actions->add(Crud::PAGE_INDEX, $export);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('member.crud.title.singular')
            ->setEntityLabelInPlural('member.crud.title.plural')
            ->setSearchFields(['id', 'firstname', 'lastname', 'email', 'phone', 'mobilePhone', 'sex', 'niss', 'insurer'])
            ->setPaginatorPageSize(100)
            ->setDefaultSort(['lastname' => 'ASC'])
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('member.crud.form.personal'),
            IdField::new('id')->onlyOnDetail(),
            TextField::new('firstName', 'member.properties.firstname'),
            TextField::new('lastName', 'member.properties.lastname'),
            DateField::new('birthdate', 'member.properties.birthdate'),
            ChoiceField::new('sex',  'member.properties.sex')
                ->hideOnIndex()
                ->setChoices([ 'Male' => 'M', 'Female' => 'F']),
            TextField::new('niss')->hideOnIndex(),
            ChoiceField::new('insurer', 'member.properties.insurer')
                ->hideOnIndex()
                ->setChoices([
                    'PartenaMut' => 'PARTENA',
                    'Mutualité Solidaris' => 'SOLIDARIS',
                    'Mutualité Chrétienne' => 'MC'
                ]),

            FormField::addPanel('member.crud.form.contact')->collapsible(),
            EmailField::new('email', 'member.properties.email'),
            TelephoneField::new('phone', 'member.properties.phone'),
            TelephoneField::new('mobilePhone', 'member.properties.mobilePhone'),

            FormField::addPanel('member.crud.form.families')->collapsible(),
            AssociationField::new('families', 'member.properties.families')
                ->setTemplatePath('admin/field/property_family.html.twig'),

            FormField::addPanel('member.crud.form.address')->collapsible(),
            TextField::new('address.street', 'address.properties.street')->hideOnIndex(),
            TextField::new('address.streetNumber', 'address.properties.streetNumber')->hideOnIndex(),
            TextField::new('address.streetBox', 'address.properties.streetBox')->hideOnIndex(),
            TextField::new('address.zipCode', 'address.properties.zipCode')->hideOnIndex(),
            TextField::new('address.city', 'address.properties.city')->hideOnIndex(),
            CountryField::new('address.country', 'address.properties.country')->hideOnIndex(),
        ];
    }

    public function export(Request $request)
    {
        $context = $request->attributes->get(EA::CONTEXT_REQUEST_ATTRIBUTE);
        $fields = FieldCollection::new($this->configureFields(Crud::PAGE_INDEX));
        $filters = $this->get(FilterFactory::class)->create($context->getCrud()->getFiltersConfig(), $fields, $context->getEntity());
        $members = $this->createIndexQueryBuilder($context->getSearch(), $context->getEntity(), $fields, $filters)
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($members as $member) {
            $data[] = $member->getExportData();
        }

        return $this->csvService->export($data, 'export_members_'.date_create()->format('d-m-y').'.csv');
    }
}
