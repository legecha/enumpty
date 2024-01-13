<?php

declare(strict_types=1);

namespace Tests\Attributes;

use Attribute;

/**
 * A mock attribute to aid in testing.
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class MockDescribeEnum
{
    /**
     * Descriptions provided for the enum case.
     *
     * @var array<string>
     */
    public array $descriptions;

    /**
     * Create a new MockDescribeEnum instance.
     *
     * @param mixed $args,... A variable number of descriptions for the enum case.
     * @return void
     */
    public function __construct(...$descriptions)
    {
        $this->descriptions = $descriptions;
    }
}
