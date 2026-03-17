<?php

declare(strict_types=1);

namespace Maarheeze\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface as RamseyUuidInterface;
use Throwable;

final readonly class Uuid implements UuidInterface
{
    private function __construct(
        private RamseyUuidInterface $uuid,
    ) {
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public static function fromString(string $uuid): static
    {
        try {
            return new self(RamseyUuid::fromString($uuid));
        } catch (Throwable $throwable) {
            throw new UuidException('Invalid uuid string', 0, $throwable);
        }
    }

    /**
     * @param array{uuid: string} $data
     */
    public static function jsonDeserialize(array $data): static
    {
        return self::fromString($data['uuid']);
    }

    /**
     * @return array{uuid: string}
     */
    public function jsonSerialize(): array
    {
        return ['uuid' => $this->toString()];
    }

    public static function generate(): static
    {
        return new self(RamseyUuid::uuid7());
    }

    public function toString(): string
    {
        return $this->__toString();
    }
}
