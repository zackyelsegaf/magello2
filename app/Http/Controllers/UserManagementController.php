<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;                 // + ADD
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
                   // + ADD

class UserManagementController extends Controller
{
    /** User List */
    public function userList()
    {
        return view('usermanagement.listuser');
    }

    /** Add Neew Users */
    public function userAddNew()
    {
        return view('usermanagement.useraddnew');
    }

    /** View Record */
    public function userView($user_id)
    {
        $userData = User::where('user_id', $user_id)->first();
        return view('usermanagement.useredit', compact('userData'));
    }

    /** Update Record */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->avatar)) {
                $photo = $request->avatar;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/img/'), $file_name);
            } else {
                $file_name = $request->hidden_avatar;
            }

            $user = User::where('user_id', $request->user_id)->first();

            $updateRecord = [
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'position'     => $request->position,
                'avatar'       => $file_name,
                'department'   => $request->department,
                'role_name'    => $request->role_name,                    // + ADD
            ];
            // kalau ada password diisi, hash dan simpan
            if (filled($request->password)) {                             // + ADD
                $updateRecord['password'] = Hash::make($request->password);
            }                                                             // + ADD

            if ($user) {
                // MODE UPDATE (tetap sesuai punyamu)
                User::where('user_id', $request->user_id)->update($updateRecord);
                $userModel = User::where('user_id', $request->user_id)->first(); // + ADD
            } else {
                // MODE CREATE (pakai method yang sama, tanpa ganggu alurmu)  // + ADD
                // jika user_id kosong, buat sederhana
                $newUserId = $request->user_id ?: ('USR-' . now()->format('ymdHis') . rand(10, 99)); // + ADD
                $updateRecord['user_id'] = $newUserId;                       // + ADD
                // default status optional (biar aman)
                if (!isset($updateRecord['status']) && property_exists(User::class, 'status')) { /* no-op */
                } // + ADD
                $userModel = User::create($updateRecord);                    // + ADD
            }

            // === Spatie role assign (otomatis dari role_name) ===           // + ADD
            if (filled($request->role_name)) {                               // + ADD
                // bikin role kalau belum ada; guard 'web'
                $role = Role::firstOrCreate(
                    ['name' => $request->role_name, 'guard_name' => 'web']
                );
                // assign/sync ke user
                $userModel->syncRoles([$role->name]);
            }                                                                 // + ADD
            // ====================================================

            DB::commit();
            sweetalert()->success($user ? 'Updated record successfully :)' : 'Created record successfully :)'); // + tweak pesan ringan
            return redirect()->route('users/list/page');
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)' . $e->getMessage());
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }


    /** Delete Record */
    public function userDelete($id)
    {
        try {

            $deleteRecord = User::find($id);
            $deleteRecord->delete();
            sweetalert()->success('User deleted successfully :)');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('User delete fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $userEdit = User::findOrFail($id);
        if (!$userEdit) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('usermanagement.useredit', compact('userEdit'));
    }

    /** Get Users Data */
    public function getUsersData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $users =  DB::table('users');
        $totalRecords = $users->count();

        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
            $query->orWhere('email', 'like', '%' . $searchValue . '%');
            $query->orWhere('position', 'like', '%' . $searchValue . '%');
            $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
            $query->orWhere('status', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'name') {
            $columnName = 'name';
        }
        // $records = $users->orderBy($columnName, $columnSortOrder)
        //     ->where(function ($query) use ($searchValue) {
        //         $query->where('name', 'like', '%' . $searchValue . '%');
        //         $query->orWhere('email', 'like', '%' . $searchValue . '%');
        //         $query->orWhere('position', 'like', '%' . $searchValue . '%');
        //         $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
        //         $query->orWhere('status', 'like', '%' . $searchValue . '%');
        //     })
            //->skip($start)
           // ->take($length)
            //->get();

        $tableName  = (new User)->getTable();
        $cols       = Schema::getColumnListing($tableName);
        $sortColumn = in_array($columnName, $cols, true) ? $columnName : 'id';
        $sortDir    = strtolower($columnSortOrder) === 'desc' ? 'desc' : 'asc';

        $records = $users
            ->orderBy($sortColumn, $sortDir)
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
                $query->orWhere('email', 'like', '%' . $searchValue . '%');
                $query->orWhere('position', 'like', '%' . $searchValue . '%');
                $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
                $query->orWhere('status', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($length)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="userlist_checkbox" value="' . $record->user_id . '">';

            if (!empty($record->avatar) && file_exists(public_path('assets/img/' . $record->avatar))) {
                $avatarUrl = asset('../../public/assets/img/' . $record->avatar);
            } else {
                $avatarUrl = asset('assets/img/profile.png');
            }

            $avatarImg = '<img src="' . $avatarUrl . '" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">';

            // $modify = '
            //     <td class="text-right">
            //         <div class="dropdown dropdown-action">
            //             <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            //                 <i class="fas fa-ellipsis-v ellipse_color"></i>
            //             </a>
            //             <div class="dropdown-menu dropdown-menu-right">
            //                 <a class="dropdown-item" href="'.url('users/add/edit/'.$record->user_id).'">
            //                     <i class="fas fa-pencil-alt m-r-5"></i> Edit
            //                 </a>
            //                 <a class="dropdown-item" href="'.url('users/delete/'.$record->id).'">
            //                     <i class="fas fa-trash-alt m-r-5"></i> Delete
            //                 </a>
            //             </div>
            //         </div>
            //     </td>
            // ';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "user_id"      => $record->user_id,
                "avatar"       => $avatarImg,
                "name"         => $record->name,
                "email"        => $record->email,
                "position"     => $record->position,
                "phone_number" => $record->phone_number,
                "status"       => $record->status,
                // "modify"       => $modify, 
            ];
        }
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');
    }
}
