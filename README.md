# maarheeze/uuid

A simple UUID value object for PHP.

## Installation

```bash
composer require maarheeze/uuid
```

## Usage

### Generating a UUID

```php
$uuid = Uuid::generate();
```

### Creating from a string

```php
$uuid = Uuid::fromString('018e4c7a-3b2f-7000-8000-000000000000');
```

### String output

```php
(string) $uuid;
$uuid->toString();
```

### JSON

```php
$uuid->jsonSerialize();
json_encode($uuid);

Uuid::jsonDeserialize(['uuid' => '018e4c7a-3b2f-7000-8000-000000000000']);
```

## Typed identifiers

To get distinct identifier types — so a method taking a playerId cannot be
handed a gameId for example — declare your own class and use the `IsUuid` trait:

```php
use Maarheeze\Uuid\IsUuid;
use Maarheeze\Uuid\UuidInterface;

final readonly class PlayerId implements UuidInterface
{
    use IsUuid;
}
```

`PlayerId::generate()`, `PlayerId::fromString()` and `PlayerId::jsonDeserialize()`
all return a `PlayerId`.

Two suggestions:

- Mark the class `final`: the factories use `new self()`, so if
you ever extend a `PlayerId`, the subclass inherits a `generate()` that hands
back a `PlayerId` and the `static` return type throws a TypeError. `final` rules
that out, and PHPStan points it out at level max. Leaving the class open is fine
if you never extend it.
- Mark the class `readonly`, so it behaves as a value object.

`PlayerId` is deliberately **not** an `instanceof Uuid`, and two id classes are
unrelated to each other by type. `equals()` follows suit: it is false unless both
sides are the same class, so a `PlayerId` never equals a `GameId` even when they
hold the same value.

## License

MIT