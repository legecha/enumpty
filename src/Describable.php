<?php

declare(strict_types=1);

namespace Legecha\Enumpty;

use Legecha\Enumpty\Attributes\DescribeEnum;
use ReflectionClass;
use ReflectionEnum;
use ReflectionEnumUnitCase;
use Throwable;

trait Describable
{
    /**
     * Return the correct value based on the description.
     */
    public function __call(string $name, array $default): mixed
    {
        // Get a specific description for all cases.
        $matches = [];
        if (preg_match('/(.*)Cases$/', $name, $matches)) {
            return $matches[0];
        }

        return $this->getDescription($name, $default[0] ?? null);
    }

    /**
     * Return the correct value based on the description.
     */
    public static function __callStatic(string $name, array $default): mixed
    {
        $descriptionType = preg_replace('/Cases$/', '', $name);

        $cases = [];
        foreach ((new ReflectionEnum(static::class))->getCases() as $case) {
            $caseName = static::class.'::'.$case->getName();
            $description = null;

            $attributes = $case->getAttributes(DescribeEnum::class);

            if (empty($attributes)) {
                $cases[$caseName] = null;
                continue;
            }

            // Always the first (and only) DescribeEnum attribute.
            $instance = $attributes[0]->newInstance();
            $description = $instance->descriptions[$descriptionType] ?? null;

            $cases[$caseName] = $description;
        }

        return $cases;
    }

    protected function getDescription($name, mixed $default): mixed
    {
        $attributes = (new ReflectionEnumUnitCase(self::class, $this->name))->getAttributes(DescribeEnum::class);

        if (empty($attributes)) {
            return null;
        }

        // Always the first (and only) DescribeEnum attribute.
        $instance = $attributes[0]->newInstance();
        return $instance->descriptions[$name] ?? $default ?? null;
    }
}
