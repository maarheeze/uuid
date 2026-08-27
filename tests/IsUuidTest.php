<?php

declare(strict_types=1);

namespace Tests;

use Maarheeze\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\AdminAccountId;
use Tests\Fixtures\GameId;
use Tests\Fixtures\PlayerId;

class IsUuidTest extends TestCase
{
    public function testGenerateReturnsUsingClass(): void
    {
        self::assertInstanceOf(PlayerId::class, PlayerId::generate());
    }

    public function testFromStringReturnsUsingClass(): void
    {
        self::assertInstanceOf(PlayerId::class, PlayerId::fromString(Uuid::generate()->toString()));
    }

    public function testJsonDeserializeReturnsUsingClass(): void
    {
        self::assertInstanceOf(PlayerId::class, PlayerId::jsonDeserialize(Uuid::generate()->jsonSerialize()));
    }

    public function testGenerateReturnsTheSubclassWhenTheIdIsExtended(): void
    {
        self::assertInstanceOf(AdminAccountId::class, AdminAccountId::generate());
    }

    public function testFromStringReturnsTheSubclassWhenTheIdIsExtended(): void
    {
        self::assertInstanceOf(
            AdminAccountId::class,
            AdminAccountId::fromString(Uuid::generate()->toString()),
        );
    }

    public function testIdsOfTheSameClassWithTheSameValueAreEqual(): void
    {
        $playerId = PlayerId::generate();

        self::assertTrue($playerId->equals(PlayerId::fromString($playerId->toString())));
    }

    public function testIdsOfDifferentClassesAreNotEqual(): void
    {
        $playerId = PlayerId::generate();

        self::assertFalse($playerId->equals(GameId::fromString($playerId->toString())));
    }

    public function testAUuidIsNotEqualToATypedIdWithTheSameValue(): void
    {
        $uuid = Uuid::generate();

        self::assertFalse($uuid->equals(PlayerId::fromString($uuid->toString())));
    }
}
