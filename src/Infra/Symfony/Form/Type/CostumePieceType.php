<?php

namespace Infra\Symfony\Form\Type;

use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\CrudAutocompleteType;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Infra\EasyAdmin\Controller\ClothesPieceCrudController;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostumePiece;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostumePieceType extends AbstractType
{
    private AdminUrlGenerator $urlGenerator;
    private AdminContextProvider $contextProvider;

    public function __construct(AdminUrlGenerator $urlGenerator, AdminContextProvider $contextProvider)
    {
        $this->urlGenerator = $urlGenerator;
        $this->contextProvider = $contextProvider;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('piece', CrudAutocompleteType::class, [
                'class' => ClothesPiece::class,
                'required' => true,
                'attr' => [
                    'data-ea-align' => 'left',
                    'data-ea-widget' => 'ea-autocomplete',
                    'data-ea-autocomplete-endpoint-url' => $this->getSearchEndpoint(),
                ],
                /*'choice_label' => 'codeDisplayName',
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('piece')
                    ->orderBy('piece.code', 'ASC'),*/
            ])
            ->add('isDefault')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClothesCostumePiece::class
        ]);
    }

    protected function getSearchEndPoint(): string
    {
        $context = $this->contextProvider->getContext();
        if (!$context) {
            throw new \RuntimeException('No context found');
        }
        $crud = $context->getCrud();
        if (!$crud)  {
            throw new \RuntimeException('No CRUD found');
        }
        $page = $crud->getCurrentPage();

        return $this->urlGenerator
            ->unsetAll()
            ->set('page', 1)
            ->setController(ClothesPieceCrudController::class)
            ->setAction('autocomplete')
            ->set(AssociationField::PARAM_AUTOCOMPLETE_CONTEXT, [
                EA::CRUD_CONTROLLER_FQCN => ClothesPieceCrudController::class,
                'propertyName' => 'name',
                'originatingPage' => $page,
            ])
            ->generateUrl();
    }
}
