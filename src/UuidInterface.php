<?php

declare(strict_types=1);

namespace Maarheeze\Uuid;

use JsonSerializable;
use Stringable;

interface UuidInterface extends JsonSerializable, Stringable
{
    public static function fromString(string $uuid): static;

    public static function generate(): static;

    /**
     * @param array{uuid: string} $data
     */
    public static function jsonDeserialize(array $data): static;

    public function toString(): string;
}
