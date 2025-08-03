<?php

namespace App\Interfaces;

interface ConcessionRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $request);
    public function update($id, array $request);
    public function delete($id);
}
