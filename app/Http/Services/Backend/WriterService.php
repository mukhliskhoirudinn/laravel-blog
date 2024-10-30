<?php

namespace App\Http\Services\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class WriterService
{
    public function dataTable($request)
    {

        if ($request->ajax()) {
            $totalData = User::count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            if (empty($request->search['value'])) {
                $data = User::offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified']);
            } else {
                $data = User::filter($request->search['value'])
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified']);

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
                ->editColumn('created_at', function ($data) {
                    return date('d-m-Y H:i:s', strtotime($data->created_at));
                })
                ->editColumn('is_verified', function ($data) {
                    return $data->is_verified ? '<span class="badge bg-success">' . date('d-m-Y H:i:s', strtotime($data->is_verified)) . '</span>' : '<span class="badge bg-danger">Unverified</span>';
                })

                ->addColumn('action', function ($data) {
                    $actionBtn = '
                    <div class="text-center" width="10%">
                        <div class="btn-group">

                            ' . (!$data->is_verified ? '
                            <button type="button" class="btn btn-sm btn-warning" onclick="verifyData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-check"></i>
                            </button>' : '') . '

                            <button type="button" class="btn btn-sm btn-success" onclick="editData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            
                        </div>
                    </div>
                    ';

                    return $actionBtn;
                })

                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start
                ])
                ->rawColumns(['action', 'is_verified'])
                ->make();
        }
    }

    public function verifyWriter($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = now(); // Atur waktu verifikasi
        $user->save();

        return response()->json(['message' => 'Writer verified successfully.']);
    }
}
