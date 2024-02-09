<?php

declare(strict_types=1);

namespace Legecha\Enumpty;

trait Names
{
    /**
     * Return a nicely formatted name based on the case name.
     */
    public function name()
    {
        return self::formatName($this->name);
    }

    /**
     * Return a nicely formatted name for all cases.
     */
    public static function names()
    {
        $cases = [];
        foreach ((new \ReflectionEnum(static::class))->getCases() as $case) {
            $caseName = static::class.'::'.$case->getName();
            $cases[$caseName] = static::formatName($case->getName());
        }

        return $cases;
    }

    /**
     * Format case names into nicely formatted names.
     */
    protected static function formatName(string $name)
    {
        return mb_convert_case(
            implode(' ', preg_split('/(?=\p{Lu})/u', $name, -1, PREG_SPLIT_NO_EMPTY)),
            MB_CASE_TITLE,
            'UTF-8',
        );
    }
}
