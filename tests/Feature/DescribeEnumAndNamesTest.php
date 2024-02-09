<?php

declare(strict_types=1);

use Legecha\Enumpty\Describable;
use Legecha\Enumpty\Names;
use Tests\Enums\MockDescribeEnumAndNames;
use Tests\Enums\MockDescribeEnumAndNamesClash;

it('can use Describable and Names traits on the same enum', function (BackedEnum $enum) {
    $reflection = new ReflectionClass($enum);
    expect($reflection->getTraitNames())
        ->toContain(
            Describable::class,
            Names::class,
        );
})->with([
    MockDescribeEnumAndNames::TheFirst,
    MockDescribeEnumAndNamesClash::TheFirst,
]);

it('will prioritise the name method over custom descriptions', function (BackedEnum $enum, string $name) {
    expect($enum)
        ->name()
            ->toBe($name);
})->with([
    [MockDescribeEnumAndNamesClash::TheFirst, 'The First'],
]);

it('can prioritise the name method when providing names for all cases for an enum', function () {
    expect(MockDescribeEnumAndNamesClash::names())
        ->toBe([
            MockDescribeEnumAndNamesClash::class.'::TheFirst' => 'The First',
            MockDescribeEnumAndNamesClash::class.'::AndTheSecond' => 'And The Second',
            MockDescribeEnumAndNamesClash::class.'::Third' => 'Third',
            MockDescribeEnumAndNamesClash::class.'::ThenThisIsTheFourth' => 'Then This Is The Fourth',
        ]);
});
