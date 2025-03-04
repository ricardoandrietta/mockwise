<?php

namespace MockWise\Domain\Interfaces;

use InvalidArgumentException;

interface JSONSchemaValidationInterface
{
    /**
     * @param array $data
     * @param string $pathToSchema
     * @return void
     * @throws InvalidArgumentException
     */
    public function validate(array $data, string $pathToSchema): void;
}
