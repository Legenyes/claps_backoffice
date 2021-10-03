<?php

namespace App\Controller\Admin;

use App\Entity\ClothesColor;
use App\Entity\ClothesCostume;
use App\Entity\ClothesOpportunity;
use App\Entity\ClothesPiece;
use App\Entity\ClothesPieceStock;
use App\Entity\ClothesSeason;
use App\Entity\ClothesTexture;
use App\Entity\ClothesType;
use App\Entity\ClothesTypeZone;
use App\Entity\Club;
use App\Entity\ClubYear;
use App\Entity\Event;
use App\Entity\Member;
use App\Entity\MemberShip;
use App\Entity\Playlist;
use App\Entity\Section;
use App\Entity\User;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Clap\'Sabots');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('dd/MM/yyyy')
            ->setDateTimeFormat('dd/MM/yyyy HH:mm:ss')
            ->setTimeFormat('HH:mm')
            ->overrideTemplate('label/null', 'easy_admin/label_null.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        $submenu1 = [
            MenuItem::linkToCrud('Club', '', Club::class),
            MenuItem::linkToCrud('ClubYear', '', ClubYear::class),
            MenuItem::linkToCrud('Section', '', Section::class),
            MenuItem::linkToCrud('User', '', User::class),
            MenuItem::linkToCrud('Event', '', Event::class),
        ];

        $submenu2 = [
            MenuItem::linkToCrud('Member', '', Member::class),
            MenuItem::linkToCrud('MemberShip', '', MemberShip::class),
        ];

        $submenu3 = [
            MenuItem::linkToCrud('Costumes', '', ClothesCostume::class),
            MenuItem::linkToCrud('Pieces', '', ClothesPiece::class),
            MenuItem::linkToCrud('Stock', '', ClothesPieceStock::class),
            MenuItem::linkToCrud('Types', '', ClothesType::class),
            MenuItem::linkToCrud('Opportunity', '', ClothesOpportunity::class),
            MenuItem::linkToCrud('Seasons', '', ClothesSeason::class),
            MenuItem::linkToCrud('Textures', '', ClothesTexture::class),
            MenuItem::linkToCrud('Zones', '', ClothesTypeZone::class),
            MenuItem::linkToCrud('Color', '', ClothesColor::class),
        ];

        $submenu4 = [
            MenuItem::linkToCrud('Video', '', Video::class),
            MenuItem::linkToCrud('Playlist', '', Playlist::class),
        ];

        yield MenuItem::subMenu('Administration', 'fas fa-folder-open')->setSubItems($submenu1);
        yield MenuItem::subMenu('Membres', 'fas fa-folder-open')->setSubItems($submenu2);
        yield MenuItem::subMenu('Costumes', 'fas fa-folder-open')->setSubItems($submenu3);
        yield MenuItem::subMenu('Medias', 'fas fa-folder-open')->setSubItems($submenu4);
    }
}
