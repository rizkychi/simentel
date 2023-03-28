<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public $title = 'Kategori Menara';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.master.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.master.category.form')
            ->with('title', $this->title)
            ->with('page_title', 'Tambah ' . $this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create new object
        $cat = new Category();
        $cat->category = $request->category;

        // Store into database
        if ($cat->save()) {
            return redirect()->route('master.category.index')->with('success', 'Penambahan ' . $this->title . ' baru berhasil');
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
    public function show($id)
    {
        return redirect()->route('master.category.edit', ['category' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        return view('main.master.category.form')
            ->with('title', $this->title)
            ->with('page_title', 'Ubah ' . $this->title)
            ->with('data', $cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Finding id
        $cat = Category::findOrFail($id);
        
        // Update data
        $cat->category = $request->category;

        if ($cat->update()) {
            return redirect()->route('master.category.index')->with('success', 'Perubahan ' . $this->title . ' baru berhasil');
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
            $data = Category::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $cols = '<div class="d-flex">';
                    $cols .= '<a href="' . route('master.category.edit', ['category' => $row->id]) . '" class="btn-sm btn-primary mx-1" title="Edit"><i class="fas fa-pen"></i></a>';
                    $cols .= '<a href="" data-url="' . route('master.category.delete', ['category' => $row->id]) . '" data-text="' . $this->title . '" class="btn-sm btn-danger mx-1" onclick="deleteConfirm(event, this)" title="Hapus"><i class="fas fa-trash"></i></a>';
                    $cols .= '</div>';
                    return $cols;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // Delete data
    public function delete($id)
    {
        $data = Category::findOrFail($id);
        if ($data->delete()) {
            return back()->with('success', $this->title . ' berhasil dihapus');
        } else {
            return back()->with('errors', 'Terjadi kesalahan, silahkan coba kembali');
        }
    }
}
