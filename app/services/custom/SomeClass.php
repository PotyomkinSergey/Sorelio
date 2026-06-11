<?php

declare(strict_types=1);

namespace App\services\custom;

class SomeClass implements CustomInterface
{

    public function someFunction(): string
    {
        $string = "some string from some function\n";
        echo($string);
        return $string;
    }
}
