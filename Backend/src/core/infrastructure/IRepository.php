<?php


namespace App\core\infrastructure;


interface IRepository
{
    public function create();

    public function update();

    public function read();

    public function delete();
}