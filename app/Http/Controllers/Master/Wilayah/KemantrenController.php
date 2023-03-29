<?php

namespace App\Http\Controllers\Master\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\WilKabupaten;
use App\Models\WilKecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KemantrenController extends Controller
{
    public $title = 'Wilayah Kemantren';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kabupaten)
    {
        $kab = WilKabupaten::findOrFail($kabupaten);
        return view('main.master.wilayah.kemantren.index')
            ->with('title', $this->title)
            ->with('page_title', $this->title . ' Master')
            ->with('kabupaten', $kab);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.master.wilayah.kemantren.form')
            ->with('title', $this->title)
            ->with('page_title', 'Tambah ' . $this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kabupaten)
    {
        $kab = WilKabupaten::find($kabupaten);
        if (!$kab) {
            return back()->with('errors', 'Terjadi kesalahan, Kabupaten tidak ditemukan')->withInput();
        }

        // Create new object
        $kec = new WilKecamatan();
        $kec->kabupaten_id = $kab->id;
        $kec->kecamatan_kode = $request->kecamatan_kode;
        $kec->kecamatan = $request->kecamatan;

        // Store into database
        if ($kec->save()) {
            return redirect()->route('master.wilayah.kemantren.index', ['kabupaten' => $kabupaten])->with('success', 'Penambahan ' . $this->title . ' baru berhasil');
        } else {
            return back()->with('errors', 'Terjadi kesalahan, silahkan coba kembali')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kabupaten, $id)
    {
        return redirect()->route('master.wilayah.kemantren.edit', ['kabupaten' => $kabupaten, 'kemantren' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kabupaten, $id)
    {
        $kec = WilKecamatan::findOrFail($id);
        return view('main.master.wilayah.kemantren.form')
            ->with('title', $this->title)
            ->with('page_title', 'Ubah ' . $this->title)
            ->with('data', $kec);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kabupaten, $id)
    {
        $kab = WilKabupaten::find($kabupaten);
        if (!$kab) {
            return back()->with('errors', 'Terjadi kesalahan, Kabupaten tidak ditemukan')->withInput();
        }

        // Finding id
        $kec = WilKecamatan::findOrFail($id);

        // Update data
        $kec->kecamatan_kode = $request->kecamatan_kode;
        $kec->kecamatan = $request->kecamatan;

        if ($kec->update()) {
            return redirect()->route('master.wilayah.kemantren.index', ['kabupaten' => $kabupaten])->with('success', 'Perubahan ' . $this->title . ' baru berhasil');
        } else {
            return back()->with('errors', 'Terjadi kesalahan, silahkan coba kembali')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Display list in json
    public function json(Request $request)
    {
        if ($request->ajax()) {
            $data = WilKecamatan::where('kabupaten_id', '=', $request->kabupaten)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cols = '<div class="d-flex">';
                    $cols .= '<a href="' . route('master.wilayah.kelurahan.index', ['kemantren' => $row->id]) . '" class="btn-sm btn-info mx-1 text-nowrap" title="Kelurahan"><i class="fas fa-map-marker-alt mr-1"></i>Kelurahan</a>';
                    $cols .= '<a href="' . route('master.wilayah.kemantren.edit', ['kabupaten' => $row->kabupaten_id, 'kemantren' => $row->id]) . '" class="btn-sm btn-primary mx-1" title="Edit"><i class="fas fa-pen"></i></a>';
                    $cols .= '<a href="" data-url="' . route('master.wilayah.kemantren.delete', ['kabupaten' => $row->kabupaten_id, 'kemantren' => $row->id]) . '" data-text="' . $this->title . '" class="btn-sm btn-danger mx-1" onclick="deleteConfirm(event, this)" title="Hapus"><i class="fas fa-trash"></i></a>';
                    $cols .= '</div>';
                    return $cols;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Delete data
    public function delete($kabupaten, $id)
    {
        $data = WilKecamatan::findOrFail($id);
        if ($data->delete()) {
            return back()->with('success', $this->title . ' berhasil dihapus');
        } else {
            return back()->with('errors', 'Terjadi kesalahan, silahkan coba kembali');
        }
    }
}
