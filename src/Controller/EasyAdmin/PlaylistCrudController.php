<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Playlist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Playlist')
            ->setEntityLabelInPlural('Playlist')
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(100)
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $playlistVideos = AssociationField::new('playlistVideos');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $playlistVideos];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $playlistVideos];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $playlistVideos];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $playlistVideos];
        }
    }
}
