<?php

namespace App\Controller\Admin;

use App\Controller\EasyAdmin\MemberCrudController;
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
use App\Entity\MemberFamily;
use App\Entity\MemberShip;
use App\Entity\Playlist;
use App\Entity\Section;
use App\Entity\User;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(MemberCrudController::class)->generateUrl());
    }

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

    public function configureActions(): Actions
    {
        $actions = parent::configureActions();

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
            ;
    }

    public function configureMenuItems(): iterable
    {
        $submenuAdmin = [
            MenuItem::linkToCrud('Club', 'fa fa-building', Club::class),
            MenuItem::linkToCrud('ClubYear', 'fa fa-calendar-alt', ClubYear::class),
            MenuItem::linkToCrud('Section', 'fa fa-list', Section::class),
            MenuItem::linkToCrud('User', 'fa fa-user-circle-o', User::class),
        ];

        $submenuMember = [
            MenuItem::linkToCrud('Members', 'fa fa-user', Member::class),
            MenuItem::linkToCrud('Families', 'fa fa-users', MemberFamily::class),
            MenuItem::linkToCrud('MemberShip', 'fa fa-address-card', MemberShip::class),
        ];

        $submenuClothe = [
            MenuItem::linkToCrud('Costumes', 'fa fa-user-tie', ClothesCostume::class),
            MenuItem::linkToCrud('Pieces', 'fa fa-tshirt', ClothesPiece::class),
            MenuItem::linkToCrud('Stock', 'fa fa-cubes', ClothesPieceStock::class),
            MenuItem::linkToCrud('Types', 'fa fa-filter', ClothesType::class),
            MenuItem::linkToCrud('Opportunity', 'fa fa-glass-cheers', ClothesOpportunity::class),
            MenuItem::linkToCrud('Seasons', 'fa fa-cloud-sun', ClothesSeason::class),
            MenuItem::linkToCrud('Textures', 'fa fa-feather', ClothesTexture::class),
            MenuItem::linkToCrud('Zones', 'fa fa-map-marked-alt', ClothesTypeZone::class),
            MenuItem::linkToCrud('Color', 'fa fa-paint-brush', ClothesColor::class),
        ];

        $submenuMedia = [
            MenuItem::linkToCrud('Video', 'fa fa-film', Video::class),
            MenuItem::linkToCrud('Music', 'fa fa-music', Video::class),
            MenuItem::linkToCrud('Playlist', 'fa fa-list', Playlist::class),
        ];

        $submenuEvent = [
            MenuItem::linkToCrud('Event', 'fa fa-calendar-alt', Event::class),
            MenuItem::linkToCrud('Reservation', 'fa fa-ticket-alt', Event::class),
        ];

        $submenuMarketing = [
            MenuItem::linkToCrud('Newsletter', 'fa fa-mailchimp', Event::class),
        ];

        yield MenuItem::subMenu('Administration', 'fas fa-cogs')->setSubItems($submenuAdmin);
        yield MenuItem::subMenu('Membres', 'fa fa-users')->setSubItems($submenuMember);
        yield MenuItem::subMenu('Costumes', 'fas fa-tshirt')->setSubItems($submenuClothe);
        yield MenuItem::subMenu('Medias', 'fas fa-photo-video')->setSubItems($submenuMedia);
        yield MenuItem::subMenu('Event', 'fa fa-calendar-alt')->setSubItems($submenuEvent);
        yield MenuItem::subMenu('Marketing', 'fas fa-bullhorn')->setSubItems($submenuMarketing);
    }
}
