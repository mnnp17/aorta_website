<?php

namespace App\Contracts\Interfaces;

interface UpdateInterface
{
    public function update(string $id, array $data): mixed;
}
