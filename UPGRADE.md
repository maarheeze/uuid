# Upgrade guide

Breaking changes per major version, newest first.

## 2.x to 3.0

No application code changes for anyone using `Uuid`. Its API and behaviour are
unchanged.

`equals()` now compares the concrete class as well as the value: it is false
unless both sides are the same class. Under 2.x it compared the string value
alone, so any two `UuidInterface` implementations holding the same value were
equal. This only matters if you wrote your own `UuidInterface` implementation
and compared it against a `Uuid` — that comparison now returns false. `Uuid`
against `Uuid` is unaffected.

The narrowing is what makes the new `IsUuid` trait worth having: identifier
classes declared with it are distinct types, and a `PlayerId` should never equal
a `GameId` that happens to hold the same value. See the README for how to
declare one.

## 1.x to 2.0

No application code changes. The package now requires PHP 8.4 — upgrade your
runtime first, then the package.
