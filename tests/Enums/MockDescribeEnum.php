<?php

declare(strict_types=1);

namespace Tests\Enums;

use Legecha\Enumpty\Attributes\DescribeEnum;
use Legecha\Enumpty\Describable;
use Tests\Attributes\MockDescribeEnum as AttributesMockDescribeEnum;

enum MockDescribeEnum: string
{
    use Describable;

    #[DescribeEnum(label: 'Label 1', description: 'Description 1', colour: 'red', count: 123, default: true)]
    case First = 'first';
    #[DescribeEnum(label: 'Label 2', description: 'Description 2', colour: 'amber', count: 223, default: false)]
    case Second = 'second';
    #[DescribeEnum(label: 'Label 3', description: 'Description 3', colour: 'green', count: 323)]
    case Third = 'third';
    #[DescribeEnum(label: 'Label 4', description: 'Description 4', colour: 'black')]
    case Fourth = 'fourth';
    #[DescribeEnum(label: 'Label 5', description: 'Description 5')]
    case Fifth = 'fifth';
    #[DescribeEnum(label: 'Label 6')]
    case Sixth = 'sixth';
    case Seventh = 'seventh';
    #[AttributesMockDescribeEnum(label: 'Label alternative')]
    case Alternative = 'alternative';
}
