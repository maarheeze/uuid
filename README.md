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

- Mark the class `final`, so the id type stays a single type — a subtype
hierarchy is rarely what you want from an id.
- Mark the class `readonly`, so it behaves as a value object.

`PlayerId` is deliberately **not** an `instanceof Uuid`, and two id classes are
unrelated to each other by type. `equals()` follows suit: it is false unless both
sides are the same class, so a `PlayerId` never equals a `GameId` even when they
hold the same value. That holds down a hierarchy too — if you do extend an id
class, the subclass never equals its parent, in either direction.

## License

MIT
