# Contributing to Velyx Registry

This repository contains the Velyx registry API, component metadata, validation rules, preview rendering, and contributor-facing registry tooling.

## Code of Conduct

Participation in this repository is governed by the [Code of Conduct](CODE_OF_CONDUCT.md).

## Before You Open Work

- Search existing issues, discussions, and pull requests first.
- Keep changes narrow. Do not mix unrelated cleanup with contract changes.
- If the change affects metadata, API responses, file mapping, or preview rendering, describe that scope precisely.

## Contribution Standard

Useful contributions in this repository include:

- correcting metadata or versions
- improving validation rules
- tightening API contract consistency
- fixing preview rendering or preview source output
- improving component delivery and file mapping
- adding tests for metadata, endpoints, or preview behavior

Low-value contributions include metadata changes with no validation update, preview examples that do not reflect real components, and undocumented API behavior changes.

## Local Setup

```bash
composer install
pnpm install
cp .env.example .env
php artisan key:generate
php artisan migrate
pnpm run build
```

Useful local commands:

```bash
php artisan test
php artisan registry:validate
composer run lint
pnpm run build
```

A pull request is not ready if validation or the relevant test suite fails.

## Required Verification

Run the checks relevant to your change:

```bash
php artisan test
php artisan registry:validate
```

Also verify manually when applicable:

- affected API responses are correct
- preview rendering is correct in browser when preview files change
- metadata changes match real component directories
- file mapping remains correct for CLI consumers

## Engineering Standard

- Keep metadata, validation, API output, and previews aligned.
- Do not change contributor-facing contracts silently.
- Prefer explicit validation rules over informal conventions.
- Keep preview examples representative of real components.
- Update tests when metadata or delivery behavior changes.

## Pull Requests

A pull request should state:

- what changed
- why it changed
- which components, endpoints, or previews are affected
- how the result was verified

If the change affects previews or API output, show that explicitly.

## Architecture Constraints

When editing the registry:

- treat `meta.json`, `versions.json`, API serialization, and preview files as one contract
- validate component changes with `php artisan registry:validate`
- keep preview source and delivered component structure aligned where the docs depend on them
- prefer targeted tests when changing file mapping or metadata rules

## Security

Do not report security issues in public issues or discussions. Follow [SECURITY.md](SECURITY.md).
