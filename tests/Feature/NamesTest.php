<?php

declare(strict_types=1);

use Legecha\Enumpty\Names;
use Tests\Enums\MockNames;

it('can use Names trait on an enum', function () {
    $enum = MockNames::TheFirst;

    $reflection = new ReflectionClass($enum);
    expect($reflection->getTraitNames())
        ->toContain(Names::class);
});

it('can provide a nice name for enum cases', function (MockNames $enum, string $name) {
    expect($enum)
        ->name()
            ->toBe($name);
})->with([
    [MockNames::TheFirst, 'The First'],
    [MockNames::AndTheSecond, 'And The Second'],
    [MockNames::Third, 'Third'],
    [MockNames::ThenThisIsTheFourth, 'Then This Is The Fourth'],
]);

it('can provide names for all cases from enum', function () {
    expect(MockNames::names())
        ->toBe([
            MockNames::class.'::TheFirst' => 'The First',
            MockNames::class.'::AndTheSecond' => 'And The Second',
            MockNames::class.'::Third' => 'Third',
            MockNames::class.'::ThenThisIsTheFourth' => 'Then This Is The Fourth',
        ]);
});
