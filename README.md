# enumpty
Describe your enums!

Find yourself creating methods like `label()`, `description()` or `icon()` on your enums? This very simple package takes the legwork out of doing so for you, and gives you the same functionality without implementing the methods.

Instead, just describe your cases with attributes!

## Example

Simply use the `Describable` trait and describe your cases with the `DescribeEnum` attribute using named parameters.

Methods on the enum values are now available, as well as static `*Cases` methods on the enum type.

```php
use Legecha\Enumpty\Attributes\DescribeEnum;
use Legecha\Enumpty\Describable;

enum MyEnum
{
    use Describable;

    #[DescribeEnum(label: 'My First Case', description: "My first description")]
    case First;
    #[DescribeEnum(description: "My second description", label: 'My 2nd Case'])
    case Second;
    case Third;
    #[DescribeEnum(label: 'My Fourth Case')]
    case Fourth;
}

$enum = MyEnum::First;
$enum->label(); // string(13) "My First Case"
$enum->description(); // string(20) "My first description"

$enum = MyEnum::Third;
$enum->description(); // NULL

MyEnum::labelCases();
/*
array(4) {
  ["MyEnum::First"]=>
  string(13) "My First Case"
  ["MyEnum::Second"]=>
  string(11) "My 2nd Case"
  ["MyEnum::Third"]=>
  NULL
  ["MyEnum::Fourth"]=>
  string(14) "My Fourth Case"
}
*/
MyEnum::descriptionCases();
/*
array(4) {
  ["MyEnum::First"]=>
  string(20) "My first description"
  ["MyEnum::Second"]=>
  string(21) "My second description"
  ["MyEnum::Third"]=>
  NULL
  ["MyEnum::Fourth"]=>
  NULL
}
*/
```
## But wait, there's more!

There is also the `Names` trait, which provides a `name()` method to get a "pretty" version of your enum case's name, and a `names()` static method to retrieve them all for a specific enum. No attributes required.

```php
use Legecha\Enumpty\Names;

enum MyEnum
{
    use Names;

    case MyFirstCase;
    case Second;
    case HereIsTheThird;
    case DontForgetTheFourth;
}

$enum = MyEnum::MyFirstCase;
$enum->name(); // string(13) "My First Case"
MyEnum::HereIsTheThird->name(); // string (15) "Here Is The Third"

MyEnum::names();
/*
array(4) {
  ["MyEnum::MyFirstCase"]=>
  string(13) "My First Case"
  ["MyEnum::Second"]=>
  string(6) "Second"
  ["MyEnum::HereIsTheThird"]=>
  string(15) "Here Is The Third"
  ["MyEnum::DontForGetTheFourth"]=>
  string(23) "Dont Forget The Fourth"
}
*/
```

## Install

`composer require legecha/enumpty`

## Issues and Contributing

This is a very simple package, but pull requests are more than welcome. Please include a test and clean up the code before doing do.

```
composer test
composer fix
```
