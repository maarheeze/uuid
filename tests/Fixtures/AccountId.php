<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Maarheeze\Uuid\IsUuid;
use Maarheeze\Uuid\UuidInterface;

readonly class AccountId implements UuidInterface
{
    use IsUuid;
}
