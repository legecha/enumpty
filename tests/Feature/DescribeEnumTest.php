<?php

declare(strict_types=1);

use Legecha\Enumpty\Describable;
use Tests\Enums\MockDescribeEnum;

it('can use Describable trait on an enum', function () {
    $enum = MockDescribeEnum::First;

    $reflection = new ReflectionClass($enum);
    expect($reflection->getTraitNames())
        ->toContain(Describable::class);
});

it('can describe valid enum cases', function () {
    $enum = MockDescribeEnum::First;

    // uses: #[DescribeEnum(label: 'Label 1', description: 'Description 1', colour: 'red', count: 123, default: true)]
    expect($enum)
        ->label()->toBe('Label 1')
        ->description()->toBe('Description 1')
        ->colour()->toBe('red')
        ->count()->toBe(123)
        ->default()->toBeTrue();
});

it('can describe valid enum cases and handle data types', function () {
    $enum = MockDescribeEnum::Second;

    // uses: #[DescribeEnum(label: 'Label 2', description: 'Description 2', colour: 'amber', count: 223, default: false)]
    expect($enum)
        ->label()->toBe('Label 2')
        ->description()->toBe('Description 2')
        ->colour()->toBe('amber')
        ->count()->toBe(223)
        ->default()->toBeFalse();
});

it('can describe valid enum cases and handle missing descriptions', function () {
    $enum = MockDescribeEnum::Third;

    // uses: #[DescribeEnum(label: 'Label 3', description: 'Description 3', colour: 'green', count: 323)]
    expect($enum)
        ->label()->toBe('Label 3')
        ->description()->toBe('Description 3')
        ->colour()->toBe('green')
        ->count()->toBe(323)
        ->default()->toBeNull();
});

it('can describe valid enum cases and use defaults for missing descriptions', function () {
    $enum = MockDescribeEnum::Fourth;

    // uses: #[DescribeEnum(label: 'Label 4', description: 'Description 4', colour: 'black')]
    expect($enum)
        ->label()->toBe('Label 4')
        ->description()->toBe('Description 4')
        ->colour()->toBe('black')
        ->count(423)->toBe(423)
        ->default('sausage')->toBe('sausage');
});

it('can describe valid enum cases and ignore defaults when descriptions exist', function () {
    $enum = MockDescribeEnum::Fifth;

    // uses: #[DescribeEnum(label: 'Label 5', description: 'Description 5')]
    expect($enum)
        ->label('wrong label')->toBe('Label 5')
        ->description('wrong description')->toBe('Description 5')
        ->colour()->toBeNull()
        ->count()->toBeNull()
        ->default()->toBeNull();
});

it('can describe valid enum cases and name and value are not affected', function () {
    $enum = MockDescribeEnum::Sixth;

    // uses: #[DescribeEnum(label: 'Label 6')]
    expect($enum)
        ->label()->toBe('Label 6')
        ->description()->toBeNull()
        ->colour()->toBeNull()
        ->count()->toBeNull()
        ->default()->toBeNull()
        ->name->toBe('Sixth')
        ->value->toBe('sixth');
});

it('can handle enum cases where no description is provided', function () {
    $enum = MockDescribeEnum::Seventh;

    expect($enum)
        ->label()->toBeNull()
        ->description()->toBeNull()
        ->colour()->toBeNull()
        ->count()->toBeNull()
        ->default()->toBeNull()
        ->name->toBe('Seventh')
        ->value->toBe('seventh');
});

it('only applies to correct attribute type', function () {
    $enum = MockDescribeEnum::Alternative;

    expect($enum)
        ->label()->not()->toBe('Label alternative');
});

it('can get descriptions for all cases from enum', function () {

    expect(MockDescribeEnum::labelCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => 'Label 1',
            MockDescribeEnum::class.'::Second' => 'Label 2',
            MockDescribeEnum::class.'::Third' => 'Label 3',
            MockDescribeEnum::class.'::Fourth' => 'Label 4',
            MockDescribeEnum::class.'::Fifth' => 'Label 5',
            MockDescribeEnum::class.'::Sixth' => 'Label 6',
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);

    expect(MockDescribeEnum::descriptionCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => 'Description 1',
            MockDescribeEnum::class.'::Second' => 'Description 2',
            MockDescribeEnum::class.'::Third' => 'Description 3',
            MockDescribeEnum::class.'::Fourth' => 'Description 4',
            MockDescribeEnum::class.'::Fifth' => 'Description 5',
            MockDescribeEnum::class.'::Sixth' => null,
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);

    expect(MockDescribeEnum::colourCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => 'red',
            MockDescribeEnum::class.'::Second' => 'amber',
            MockDescribeEnum::class.'::Third' => 'green',
            MockDescribeEnum::class.'::Fourth' => 'black',
            MockDescribeEnum::class.'::Fifth' => null,
            MockDescribeEnum::class.'::Sixth' => null,
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);

    expect(MockDescribeEnum::countCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => 123,
            MockDescribeEnum::class.'::Second' => 223,
            MockDescribeEnum::class.'::Third' => 323,
            MockDescribeEnum::class.'::Fourth' => null,
            MockDescribeEnum::class.'::Fifth' => null,
            MockDescribeEnum::class.'::Sixth' => null,
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);

    expect(MockDescribeEnum::defaultCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => true,
            MockDescribeEnum::class.'::Second' => false,
            MockDescribeEnum::class.'::Third' => null,
            MockDescribeEnum::class.'::Fourth' => null,
            MockDescribeEnum::class.'::Fifth' => null,
            MockDescribeEnum::class.'::Sixth' => null,
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);

    expect(MockDescribeEnum::madeUpCases())
        ->toBe([
            MockDescribeEnum::class.'::First' => null,
            MockDescribeEnum::class.'::Second' => null,
            MockDescribeEnum::class.'::Third' => null,
            MockDescribeEnum::class.'::Fourth' => null,
            MockDescribeEnum::class.'::Fifth' => null,
            MockDescribeEnum::class.'::Sixth' => null,
            MockDescribeEnum::class.'::Seventh' => null,
            MockDescribeEnum::class.'::Alternative' => null,
        ]);
});
