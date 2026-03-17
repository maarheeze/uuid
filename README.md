# maarheeze/uuid

A simple UUID value object for PHP.

## Requirements

- PHP 8.2+

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

## License

MIT