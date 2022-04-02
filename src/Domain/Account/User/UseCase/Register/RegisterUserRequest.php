<?php

declare(strict_types=1);

namespace Domain\Account\User\UseCase\Register;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterUserRequest
{
    #[Assert\Email]
    public ?string $email = null;

    #[Assert\Length( min: 8)]
    #[Assert\NotCompromisedPassword]
    public ?string $password = null;
}
