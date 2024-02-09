<?php

declare(strict_types=1);

namespace Tests\Enums;

use Legecha\Enumpty\Names;

enum MockNames: string
{
    use Names;

    case TheFirst = 'first';
    case AndTheSecond = 'second';
    case Third = 'third';
    case ThenThisIsTheFourth = 'fourth';
}
