# Contributing to Velyx Registry

Thank you for your interest in contributing to the Velyx Registry! This document provides guidelines and instructions for contributing.

## Table of Contents

- [Code of Conduct](#code-of-conduct)
- [How Can I Contribute?](#how-can-i-contribute)
  - [Reporting Bugs](#reporting-bugs)
  - [Suggesting Enhancements](#suggesting-enhancements)
  - [Pull Requests](#pull-requests)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Testing](#testing)

## Code of Conduct

By participating in this project, you agree to abide by the [Code of Conduct](CODE_OF_CONDUCT.md).

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

**Use the Bug Report template and provide:**

- A clear and descriptive title
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Stack traces or error messages
- Laravel and PHP version
- Relevant code snippets

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion:

- Use a clear and descriptive title
- Provide a detailed description of the proposed enhancement
- Explain why this enhancement would be useful
- List examples or use cases
- Consider whether it fits the project's scope and goals

### Pull Requests

1. **Fork the repository** and create your branch from `main`.
2. **Make your changes** following our [Coding Standards](#coding-standards).
3. **Add tests** for your changes.
4. **Ensure all tests pass**.
5. **Commit your changes** with clear, descriptive commit messages.
6. **Push to your branch** and create a Pull Request.

**Pull Request Checklist:**

- [ ] Title follows Laravel convention (e.g., "[12.x] Fix component registration")
- [ ] Description clearly explains the changes and their rationale
- [ ] Code follows Laravel coding standards
- [ ] Tests are included and pass
- [ ] Documentation is updated if needed
- [ ] No breaking changes without proper justification

## Development Setup

The Velyx Registry is a Laravel 12 application serving as the component registry API and documentation site.

### Prerequisites

- PHP 8.4 or higher
- Composer 2.x
- Node.js 18+ and pnpm
- SQLite, MySQL, or PostgreSQL

### Installation

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
pnpm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
pnpm run build

# Start development server
composer run dev
```

The development server will be available at `http://localhost:8000`.

## Coding Standards

### PHP Standards

We follow [Laravel coding standards](https://laravel.com/docs/contributions):

- Follow PSR-12 coding style
- Use Laravel conventions (snake_case for database, camelCase for PHP)
- Type hint all function arguments and return types
- Add return types to all methods
- Use strict types (`declare(strict_types=1);`)
- Write descriptive, self-documenting code

### Code Formatting

Run Laravel Pint before committing:

```bash
composer run lint
```

### Documentation

- Document all public methods with PHPDoc
- Include parameter types and return types
- Add usage examples for complex functionality
- Keep comments concise and meaningful

### Livewire Components

When creating Livewire components:

- Follow Laravel Livewire best practices
- Use proper property validation
- Implement proper error handling
- Add loading states for async operations
- Test component interactions

### Blade Templates

- Use component-based architecture
- Leverage Livewire for interactivity
- Follow Tailwind CSS utility-first approach
- Ensure proper escaping of user input
- Add accessible markup (ARIA labels, etc.)

## Testing

### Running Tests

We use [Pest](https://pestphp.com/) for testing:

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test --filter=ComponentServiceTest

# Run tests in parallel
php artisan test --parallel
```

### Writing Tests

- Write unit tests for all services and business logic
- Write feature tests for HTTP endpoints and Livewire components
- Use descriptive test names that explain what is being tested
- Follow Arrange-Act-Assert pattern
- Mock external dependencies

**Example:**

```php
test('can retrieve component by name', function () {
    // Arrange
    $component = Component::factory()->create([
        'name' => 'button',
        'version' => '1.0.0',
    ]);

    // Act
    $response = $this->get("/api/components/{$component->name}");

    // Assert
    $response->assertStatus(200)
        ->assertJson([
            'name' => 'button',
            'version' => '1.0.0',
        ]);
});
```

## Building Assets

```bash
# Development build with watch
pnpm run dev

# Production build
pnpm run build
```

## Useful Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run queue worker
php artisan queue:work

# Generate IDE helper files
php artisan ide-helper:generate
php artisan ide-helper:models
```

## Getting Help

If you need help contributing:

- Check [Velyx documentation](https://docs.velyx.dev)
- Search [existing issues](https://github.com/velyx-dev/registry/issues)
- Start a [discussion](https://github.com/velyx-dev/registry/discussions)
- Contact us at [hello@velyx.dev](mailto:hello@velyx.dev)

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
