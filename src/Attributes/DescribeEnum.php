<?php

declare(strict_types=1);

namespace Legecha\Enumpty\Attributes;

use Attribute;

/**
 * Describe enum cases, using named parameters. Values are
 * then automatically available  * via helper methods.
 *
 * #[DescribeEnum(label: 'Your label', description: 'Your description', colour: 'green')]
 *
 * YourEnum::SomeCase->label()
 * YourEnum::SomeCase->description()
 * YourEnum::SomeCase->colour()
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class DescribeEnum
{
    /**
     * Descriptions provided for the enum case.
     *
     * @var array<string>
     */
    public array $descriptions;

    /**
     * Create a new DescribeEnum instance.
     *
     * @param mixed $args,... A variable number of descriptions for the enum case.
     * @return void
     */
    public function __construct(...$descriptions)
    {
        $this->descriptions = $descriptions;
    }
}
