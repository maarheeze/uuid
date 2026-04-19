<?php

declare(strict_types=1);

namespace Tests;

use JsonSerializable;
use Maarheeze\Uuid\Uuid;
use Maarheeze\Uuid\UuidException;
use Maarheeze\Uuid\UuidInterface;
use PHPUnit\Framework\TestCase;
use Stringable;

use function json_encode;

class UuidTest extends TestCase
{
    public function testGenerate(): void
    {
        self::assertInstanceOf(Uuid::class, Uuid::generate());
    }

    public function testGenerateIsUnique(): void
    {
        self::assertNotEquals(
            Uuid::generate()->toString(),
            Uuid::generate()->toString(),
        );
    }

    public function testFromString(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals($uuid->toString(), Uuid::fromString($uuid->toString())->toString());
    }

    public function testFromStringThrowsOnInvalidUuid(): void
    {
        $this->expectException(UuidException::class);

        Uuid::fromString('not-a-uuid');
    }

    public function testToString(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals($uuid->toString(), (string) $uuid);
    }

    public function testToStringMatchesToString(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals($uuid->toString(), $uuid->__toString());
    }

    public function testJsonSerialize(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals(['uuid' => $uuid->toString()], $uuid->jsonSerialize());
    }

    public function testJsonEncode(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals(
            json_encode(['uuid' => $uuid->toString()]),
            json_encode($uuid),
        );
    }

    public function testJsonDeserialize(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals(
            $uuid->toString(),
            Uuid::jsonDeserialize(['uuid' => $uuid->toString()])->toString(),
        );
    }

    public function testJsonDeserializeRoundtrip(): void
    {
        $uuid = Uuid::generate();

        self::assertEquals(
            $uuid->toString(),
            Uuid::jsonDeserialize($uuid->jsonSerialize())->toString(),
        );
    }

    public function testEqualsReturnsFalseForDifferentUuid(): void
    {
        self::assertFalse(Uuid::generate()->equals(Uuid::generate()));
    }

    public function testEqualsReturnsTrueForSameUuid(): void
    {
        $uuid = Uuid::generate();

        self::assertTrue($uuid->equals(Uuid::fromString($uuid->toString())));
    }

    public function testImplementsUuidInterface(): void
    {
        self::assertInstanceOf(UuidInterface::class, Uuid::generate());
    }

    public function testImplementsStringable(): void
    {
        self::assertInstanceOf(Stringable::class, Uuid::generate());
    }

    public function testImplementsJsonSerializable(): void
    {
        self::assertInstanceOf(JsonSerializable::class, Uuid::generate());
    }
}
