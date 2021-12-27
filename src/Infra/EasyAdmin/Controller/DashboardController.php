<?php

declare(strict_types=1);

namespace Infra\EasyAdmin\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesColor;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostume;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesOpportunity;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPieceStock;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesSeason;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesTexture;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesType;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesTypeZone;
use Infra\Symfony\Persistance\Doctrine\Entity\Club;
use Infra\Symfony\Persistance\Doctrine\Entity\ClubYear;
use Infra\Symfony\Persistance\Doctrine\Entity\Event;
use Infra\Symfony\Persistance\Doctrine\Entity\Member;
use Infra\Symfony\Persistance\Doctrine\Entity\MemberFamily;
use Infra\Symfony\Persistance\Doctrine\Entity\MemberShip;
use Infra\Symfony\Persistance\Doctrine\Entity\Playlist;
use Infra\Symfony\Persistance\Doctrine\Entity\Section;
use Infra\Symfony\Persistance\Doctrine\Entity\User;
use Infra\Symfony\Persistance\Doctrine\Entity\Video;
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

        $now = new \DateTimeImmutable();
        $submenuMember = [
            MenuItem::linkToCrud('Members', 'fa fa-user', Member::class),
            MenuItem::linkToCrud('MemberShip '.$now->format('Y'), 'fa fa-address-card', MemberShip::class),
            MenuItem::linkToCrud('Families', 'fa fa-users', MemberFamily::class),
        ];

        $submenuClothe = [
            MenuItem::linkToCrud('Costumes', 'fa fa-user-tie', ClothesCostume::class),
            MenuItem::linkToCrud('Pieces', 'fa fa-tshirt', ClothesPiece::class),
            MenuItem::linkToCrud('Stock', 'fa fa-cubes', ClothesPieceStock::class),
            MenuItem::linkToCrud('Types', 'fa fa-filter', ClothesType::class),
            MenuItem::linkToCrud('Opportunity', 'fa fa-glass-cheers', ClothesOpportunity::class),
            MenuItem::linkToCrud('Seasons', 'fa fa-cloud-sun', ClothesSeason::class),
            MenuItem::linkToCrud('Textures', 'fa fa-feather', ClothesTexture::class),
            MenuItem::linkToCrud('Zones', 'fa fa-puzzle-piece', ClothesTypeZone::class),
            MenuItem::linkToCrud('Color', 'fa fa-paint-brush', ClothesColor::class),
        ];

        $submenuMedia = [
            MenuItem::linkToCrud('Video', 'fa fa-film', Video::class),
            MenuItem::linkToDashboard('Music <small>(soon)</small>', 'fa fa-music'),
            MenuItem::linkToCrud('Playlist', 'fa fa-list', Playlist::class),
        ];

        $submenuEvent = [
            MenuItem::linkToCrud('Event', 'fa fa-calendar-alt', Event::class),
            MenuItem::linkToDashboard('Reservation <small>(soon)</small>', 'fa fa-ticket-alt', Event::class),
        ];

        $submenuMarketing = [
            MenuItem::linkToDashboard('Newsletter <small>(soon)</small>', 'fa fa-paper-plane', Event::class),
        ];

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::subMenu('Administration', 'fas fa-cogs')->setSubItems($submenuAdmin);
        }

        yield MenuItem::subMenu('Membres', 'fa fa-users')->setSubItems($submenuMember);
        yield MenuItem::subMenu('Costumes', 'fas fa-tshirt')->setSubItems($submenuClothe);
        yield MenuItem::subMenu('Medias', 'fas fa-photo-video')->setSubItems($submenuMedia);
        yield MenuItem::subMenu('Event', 'fa fa-calendar-alt')->setSubItems($submenuEvent);
        yield MenuItem::subMenu('Marketing', 'fas fa-bullhorn')->setSubItems($submenuMarketing);
    }
}
