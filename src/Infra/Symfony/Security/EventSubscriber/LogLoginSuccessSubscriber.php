<?php

declare(strict_types=1);

namespace Infra\Symfony\Security\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Infra\Symfony\Persistance\Doctrine\Entity\LoginHistory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LogLoginSuccessSubscriber implements EventSubscriberInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccess',
        ];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $request = $event->getRequest();

        $loginHistory = new LoginHistory();
        $user = $event->getUser();
        $loginHistory->setUser($user);
        $loginHistory->setDate(new \DateTime('NOW'));
        $loginHistory->setClientIp($request->getClientIp());

        $this->entityManager->persist($loginHistory);
        $this->entityManager->flush();
    }
}
