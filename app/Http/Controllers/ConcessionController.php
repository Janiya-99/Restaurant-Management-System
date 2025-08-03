<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ConcessionRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\ConcessionRepositoryInterface;

class ConcessionController extends Controller
{
    protected $concessionRepo;

    public function __construct(ConcessionRepositoryInterface $concessionRepo)
    {
        $this->concessionRepo = $concessionRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $concessions = $this->concessionRepo->all();
                return DataTables::of($concessions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (Gate::allows('concession-concession-edit')) {
                            $btn .= '<a type="button" data-id="' . $row->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="avtar avtar-xs btn-link-secondary editBtn"> <i class="ti ti-edit f-20"></i></a>';
                        }

                        if (Gate::allows('concession-concession-delete')) {
                            $btn .= ' <a type="button" data-id="' . $row->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="avtar avtar-xs btn-link-secondary btnDelete" onclick="handleDelete(\'' . route('concessions.destroy', $row['id']) . '\', { _token: \'' . csrf_token() . '\' })"> <i class="ti ti-trash f-20"></i></a>';
                        }

                        return $btn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('pages.concession.index');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConcessionRequest $request)
    {
        try {
            //code...
            $data = $request->validated();

            if ($request->hasFile('image')) {

                $folderName = 'Concession/Images';
                if (!Storage::exists($folderName)) {
                    Storage::disk('public')->makeDirectory($folderName);
                }
                $file = $request->file('image');
                $newFilename = str_replace(' ', '_', $data['name']) . '_' . time() . '.' . $file->getClientOriginalExtension();

                $filePath = $file->storeAs($folderName, $newFilename, 'public');
            }

            $data['image'] = $filePath;

            $this->concessionRepo->create($data);

            return response()->json(['message' => 'Concession created successfully'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Concession $concession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concession $concession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Concession $concession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            //code...
            $this->concessionRepo->delete($id);

            return response()->json(['message' => 'Concession deleted successfully'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
