<?php

namespace App\Contracts\Interfaces;

interface DeleteInterface
{
    public function delete(string $id): mixed;
}
