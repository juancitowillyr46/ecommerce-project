<?php
namespace App\Core\Infrastructure;

interface Repository
{
    public function create(\stdClass $object): \stdClass;

    public function update(Int $id, Object $object): Object;

    public function readById(Int $id): Object;

    public function all(Object $object): array;

    public function delete(Object $object): Object;
}