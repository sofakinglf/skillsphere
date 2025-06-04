<?php

namespace App\Http\Controllers;

use App\Models\MasterWork;
use DB;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function store(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        try {
            $work = MasterWork::create([
                'title' => $request->title,
                'rate' => $request->amount,
                'priority' => $request->priority,
                'status' => 1,
                'currency' => $request->currency,
                'paymentType' => $request->paymentType,

                'client_id' => $request->user->id,
                'description' => $request->description
            ]);

            $skills = $request->skills;
            // return $instruction;
            // if ($work) {
            foreach ($skills as $row) {
                $work->skills()->create([
                    'work_id' => $work->id,
                    'skills' => $row['skill'],

                ]);
            }
            // }
            DB::connection('mysql')->commit();
            return response()->json('Succfully created', 201);
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json(['msg' => 'Failed to store data', 'error' => $e->getMessage()], 500);
        }


    }

    public function details($id)
    {
        $query = MasterWork::query();
        $query->where('id', $id);
        $data = $query->paginate();
        return response()->json($data);
    }

    public function index()
    {
        $query = MasterWork::query();
        $data = $query->paginate();
        return response()->json($data);
    }

    public function myProject(Request $request)
    {
        $query = MasterWork::query();
        $query->with('appliedUsers')->where('client_id', $request->user->id);
        $data = $query->paginate();
        return response()->json($data);
    }

    public function AppliedList(Request $request)
    {
        $query = MasterWork::query();
        $query->whereHas('appliedUsers', function ($q) use ($request) {
            $q->where('applied_id', $request->user->id);
        })
            ->with([
                'appliedUsers' => function ($q) use ($request) {
                    $q->where('applied_id', $request->user->id);
                }
            ]);
        $data = $query->paginate();
        return response()->json($data);
    }
}
