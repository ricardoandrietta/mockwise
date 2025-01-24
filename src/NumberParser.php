<?php

declare(strict_types=1);

namespace FakeMock;

class NumberParser  {
    protected function getValidTypes(): array
    {
        return [
            'randomDigit',
            'randomNumber',
            'randomFloat',
            'numberBetween'
        ];
    }
}
