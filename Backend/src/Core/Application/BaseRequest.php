<?php
namespace App\Core\Application;


use Jawira\CaseConverter\CaseConverterException;
use Jawira\CaseConverter\Convert;
use Spatie\DataTransferObject\DataTransferObject;

class BaseRequest extends DataTransferObject implements RequestInterface
{

    public function toFormatJson(): array
    {
        $arrayData = [];

        foreach ($this->toArray() as $key => $value) {

            try {
                $convert = new Convert($key);
            } catch (CaseConverterException $e) {
                $convert = $key;
            }

            $arrayData[$convert->toCamel()] = $value;
        }

        return $arrayData;
    }

    public function toFormatModel(): array
    {
        $arrayData = [];

        foreach ($this->toArray() as $key => $value) {

            try {
                $convert = new Convert($key);
            } catch (CaseConverterException $e) {
                $convert = $key;
            }

            $arrayData[$convert->toSnake()] = $value;
        }

        return $arrayData;
    }
}