<?php

declare(strict_types=1);

namespace MockWise\Domain\Libraries;

use InvalidArgumentException;
use MockWise\Domain\Interfaces\JSONSchemaValidationInterface;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Helper;
use Opis\JsonSchema\Validator;

class OpisJSONSchemaValidation implements JSONSchemaValidationInterface
{

    /**
     * @inheritDoc
     */
    public function validate(array $data, string $pathToSchema): void
    {
        $schemaValidationFile = file_get_contents($pathToSchema);
        $validator = new Validator();
        $result = $validator->validate(Helper::toJSON($data), $schemaValidationFile);
        if (!$result->isValid()) {
            throw new InvalidArgumentException((new ErrorFormatter())->formatErrorMessage($result->error()));
        }
    }
}
