<?php

declare(strict_types=1);

namespace Tests\Enums;

use Legecha\Enumpty\Attributes\DescribeEnum;
use Legecha\Enumpty\Describable;
use Legecha\Enumpty\Names;

enum MockDescribeEnumAndNamesClash: string
{
    use Describable;
    use Names;

    #[DescribeEnum(name: 'The First 1')]
    case TheFirst = 'first';
    #[DescribeEnum(name: 'The Second 2')]
    case AndTheSecond = 'second';
    #[DescribeEnum(name: 'The Third 3')]
    case Third = 'third';
    #[DescribeEnum(name: 'The Fourth 4')]
    case ThenThisIsTheFourth = 'fourth';
}
