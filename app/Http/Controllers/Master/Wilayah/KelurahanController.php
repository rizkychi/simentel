<?php

namespace App\Http\Controllers\Master\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\WilDesa;
use App\Models\WilKecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelurahanController extends Controller
{
    public $title = 'Wilayah Kelurahan';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kemantren)
    {
        $kec = WilKecamatan::findOrFail($kemantren);
        return view('main.master.wilayah.kelurahan.index')
            ->with('title', $this->title)
            ->with('page_title', $this->title . ' Master')
            ->with('kemantren', $kec);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kemantren)
    {
        $kec = WilKecamatan::findOrFail($kemantren);
        return view('main.master.wilayah.kelurahan.form')
            ->with('title', $this->title)
            ->with('page_title', 'Tambah ' . $this->title)
            ->with('kemantren', $kec);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kemantren)
    {
        $kec = WilKecamatan::find($kemantren);
        if (!$kec) {
            return back()->with('errors', 'Terjadi kesalahan, Kemantren tidak ditemukan')->withInput();
        }

        // Create new object
        $des = new WilDesa();
        $des->kecamatan_id = $kec->id;
        $des->desa_kode = $kec->kecamatan_kode.$request->desa_kode;
        $des->desa = $request->desa;

        // Store into database
        if ($des->save()) {
            return redirect()->route('master.wilayah.kelurahan.index', ['kemantren' => $kemantren])->with('success', 'Penambahan ' . $this->title . ' baru berhasil');
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
    public function show($kemantren, $id)
    {
        return redirect()->route('master.wilayah.kelurahan.edit', ['kemantren' => $kemantren, 'kelurahan' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kemantren, $id)
    {
        $kec = WilKecamatan::findOrFail($kemantren);
        $des = WilDesa::findOrFail($id);
        return view('main.master.wilayah.kelurahan.form')
            ->with('title', $this->title)
            ->with('page_title', 'Ubah ' . $this->title)
            ->with('data', $des)
            ->with('kemantren', $kec);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kemantren, $id)
    {
        $kec = WilKecamatan::find($kemantren);
        if (!$kec) {
            return back()->with('errors', 'Terjadi kesalahan, Kemantren tidak ditemukan')->withInput();
        }

        // Finding id
        $des = WilDesa::findOrFail($id);

        // Update data
        $des->desa_kode = $kec->kecamatan_kode.$request->desa_kode;
        $des->desa = $request->desa;

        if ($des->update()) {
            return redirect()->route('master.wilayah.kelurahan.index', ['kemantren' => $kemantren])->with('success', 'Perubahan ' . $this->title . ' baru berhasil');
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
            $data = WilDesa::where('kecamatan_id', '=', $request->kemantren)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cols = '<div class="d-flex">';
                    $cols .= '<a href="' . route('master.wilayah.kelurahan.edit', ['kemantren' => $row->kecamatan_id, 'kelurahan' => $row->id]) . '" class="btn-sm btn-primary mx-1" title="Edit"><i class="fas fa-pen"></i></a>';
                    $cols .= '<a href="" data-url="' . route('master.wilayah.kelurahan.delete', ['kemantren' => $row->kecamatan_id, 'kelurahan' => $row->id]) . '" data-text="' . $this->title . '" class="btn-sm btn-danger mx-1" onclick="deleteConfirm(event, this)" title="Hapus"><i class="fas fa-trash"></i></a>';
                    $cols .= '</div>';
                    return $cols;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Delete data
    public function delete($kemantren, $id)
    {
        $data = WilDesa::findOrFail($id);
        if ($data->delete()) {
            return back()->with('success', $this->title . ' berhasil dihapus');
        } else {
            return back()->with('errors', 'Terjadi kesalahan, silahkan coba kembali');
        }
    }
}
