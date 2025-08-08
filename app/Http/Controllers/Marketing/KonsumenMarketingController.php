<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KonsumenMarketingController extends Controller
{
    public function KonsumenMarketingList()
    {
        return view('marketing.konsumen.konsumenmarketing');
    }

    public function KonsumenMarketingAddNew()
    {
        return view('marketing.konsumen.konsumenmarketingaddnew');
    }
}

<?php

namespace App\Http\Controllers\Marketing;

use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class KonsumenMarketingController extends Controller
{
    public function KonsumenMarketingList()
    {
        return view('marketing.konsumen.konsumenmarketing');
    }

    public function KonsumenMarketingAddNew()
    {
        return view('marketing.konsumen.konsumenmarketingaddnew');
    }

    public function delete(Request $request){
        try {
            $ids = $request->ids;
            Konsumen::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('konsumenmarketing/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getKonsumen(Request $request) {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_konsumen');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $konsumen =  DB::table('konsumen');
        $totalRecords = $konsumen->count();

        if ($namaFilter) {
            $konsumen->where('nama_konsumen', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $konsumen->count();

        $records = $konsumen
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
            
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="konsumen_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"      => $checkbox,
                "no"            => $start + $key + 1,
                "id"            => $record->id,
                "nik_konsumen"  => $record->nik_konsumen,
                "nama_konsumen" => $record->nama_konsumen,
                'no_hp'         => $record->no_hp,
                // 'email'         => $record->email,
                'cluster'       => $record->cluster,
                'kota'          => $record->kota,
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
