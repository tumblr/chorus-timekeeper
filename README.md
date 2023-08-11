# Chorus TimeKeeper

The **Chorus TimeKeeper** is an elegant utility for Dependency Injection (DI) with timekeeping. At its core, it offers a straightforward approach to time management in applications, allowing for consistent time retrieval and even time manipulation for testing purposes. This can be exceptionally helpful when writing tests or simulating various time conditions in your code.

It provides two primary components:
1. `TimeKeeper`: Fetches real-time data.
2. `FakeTimeKeeper`: Helps in mocking or manipulating time during testing.

For example, when testing time-sensitive components, you can utilize `FakeTimeKeeper` to preset time scenarios, avoiding the hassle of waiting in real-time or simulating date changes on your system.

## Requirements

- PHP ^7.4 or ^8.0

## Installation

You can install the package via Composer:

```bash
composer require tumblr/chorus-timekeeper
```


## Basic Usage

```php
// Using the real TimeKeeper
$timekeeper = new Tumblr\Chorus\TimeKeeper();

echo $timekeeper->getCurrentUnixTime();  // Outputs the current unix epoch time.

// Using the FakeTimeKeeper
$fakeTimeKeeper = new Tumblr\Chorus\FakeTimeKeeper(1628700000);  // Set a specific unix time.

echo $fakeTimeKeeper->getCurrentUnixTime();  // Outputs 1628700000.

```

The project has a Makefile to simplify development processes. You can use various make commands to run tests, validate code standards, and more. Here's a quick overview:

### 1. Prerequisites Setup

Ensure your environment is set up correctly:

- Install required packages:
```bash
make prerequisites
```

- Report PHP location:
```bash
make report-php-location
```

### 2. Testing

Run all tests:
```bash
make test
```

Run only PHPUnit tests:
```bash
make phpunit
```

Generate PHPUnit test coverage:
```bash
make phpunit-coverage
```

### 3. Static Analysis

Use psalm for static analysis:
```bash
make sa
```

### 4. Code Standards

Fix coding standards using PHP CS Fixer:
```bash
make cs
```

### 5. Mutation Testing

Run mutation tests to ensure code quality:
```bash
make mt
```

### 6. Composer

Validate composer files:
```bash
make composer-validate
```

### 7. YAML Linting

Lint YAML files to ensure correctness:
```bash
make yamllint
```

## Contributing

If you wish to contribute to the Chorus TimeKeeper, please follow these steps:

1. **Raise an Issue**: Before making any changes, create an issue describing your idea or the desired change.
2. **Submit a PR**: Once your idea is approved, create a Pull Request. Make sure to include or update unit tests.
3. **Testing & Code Style**: Ensure all tests pass (`make test`) and fix any code style issues (`make cs`).
4. **Describe Your Changes**: Clearly describe what you've changed and include testing instructions.
5. **Breaking Changes Alert**: If your contribution introduces breaking changes, please highlight them. Any modification that disrupts the current workflow, like changing a namespace or functionality, is a breaking change.

Remember, if you're planning a significant refactor or introducing breaking changes, your PR might not be approved.

Once your PR is approved, it will be merged, and a new version will be released.

## License

This project is licensed under the [GNU GENERAL PUBLIC LICENSE](LICENSE).
