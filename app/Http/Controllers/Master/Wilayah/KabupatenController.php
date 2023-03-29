<?php

namespace App\Http\Controllers\Master\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\WilKabupaten;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KabupatenController extends Controller
{
    public $title = 'Wilayah Kabupaten';

    public function index()
    {
        return view('main.master.wilayah.kabupaten.index')
            ->with('title', $this->title)
            ->with('page_title', $this->title . ' Master');
    }

    // Display list in json
    public function json(Request $request)
    {
        if ($request->ajax()) {
            $data = WilKabupaten::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cols = '<div class="d-flex">';
                    $cols .= '<a href="' . route('master.wilayah.kemantren.index', ['kabupaten' => $row->id]) . '" class="btn-sm btn-info mx-1 text-nowrap" title="Kemantren"><i class="fas fa-map-marker-alt mr-1"></i>Kemantren</a>';
                    $cols .= '</div>';
                    return $cols;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
