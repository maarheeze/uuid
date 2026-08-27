<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Maarheeze\Uuid\IsUuid;
use Maarheeze\Uuid\UuidInterface;

final readonly class PlayerId implements UuidInterface
{
    use IsUuid;
}
