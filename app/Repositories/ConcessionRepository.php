<?php

namespace App\Repositories;

use App\Interfaces\ConcessionRepositoryInterface;
use App\Models\Concession;

class ConcessionRepository implements ConcessionRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
        return Concession::latest()->get();
    }

    public function find($id)
    {
        return Concession::findOrFail($id);
    }

    public function create(array $request)
    {
        return Concession::create($request);
    }

    public function update($id, array $request)
    {
        $concession = $this->find($id);

        $concession->update($request);
        return $concession;
    }

    public function delete($id)
    {
        $concession = $this->find($id);
        return $concession->delete();
    }
}
