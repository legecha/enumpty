<?php

declare(strict_types=1);

namespace Tests\Enums;

use Legecha\Enumpty\Attributes\DescribeEnum;
use Legecha\Enumpty\Describable;
use Legecha\Enumpty\Names;

enum MockDescribeEnumAndNames: string
{
    use Describable;
    use Names;

    #[DescribeEnum(label: 'The First 1')]
    case TheFirst = 'first';
    #[DescribeEnum(label: 'The Second 2')]
    case AndTheSecond = 'second';
    #[DescribeEnum(label: 'The Third 3')]
    case Third = 'third';
    #[DescribeEnum(label: 'The Fourth 4')]
    case ThenThisIsTheFourth = 'fourth';
}
