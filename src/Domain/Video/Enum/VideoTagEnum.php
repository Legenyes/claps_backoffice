<?php

declare(strict_types=1);

namespace Domain\Video\Enum;

enum VideoTagEnum: string
{
    case Show = 'show';
    case Workshop = 'wokshop';
}
