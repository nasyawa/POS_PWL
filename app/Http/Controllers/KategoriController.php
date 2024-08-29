<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Kategori',
            'list' => ['Home', 'Kategori']
        ];

        return  view('kategori.index')
            ->with('activeMenu', $activeMenu)
            ->with('breadcrumb', $breadcrumb);
    }

    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/confirm') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return  view('kategori.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => ['required', 'max:10', 'unique:m_kategori,kategori_kode'],
                'kategori_nama' => ['required', 'max:100', 'min:3']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            KategoriModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = KategoriModel::find($id);

        return  view('kategori.show')
            ->with('kategori', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return  view('kategori.edit')
            ->with('kategori', $kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    { 
        if ($request->ajax() || $request->wantsJson()) { 
            $rules = [ 
                'kategori_kode' => ['required', 'max:10', 'unique:m_kategori,kategori_kode,'.$id.',kategori_id'], 
                'kategori_nama' => [ 'required', 'min:3', 'max:100'] 
            ]; 
         
            // use Illuminate\Support\Facades\Validator; 
            $validator = Validator::make($request->all(), $rules); 
            if ($validator->fails()) { 
                return response()->json([ 
                    'status' => false, // respon json, true: berhasil, false: gagal 
                    'message' => 'Validasi gagal.', 
                    'msgField' => $validator->errors() // menunjukkan field mana yang error 
                ]); 
            } 
 
            $check = KategoriModel::find($id); 
             
            if ($check) { 
                $check->update($request->all()); 
                return response()->json([ 
                    'status' => true, 
                    'message' => 'Data berhasil diupdate' 
                ]); 
            } else{ 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Data tidak ditemukan' 
                ]); 
            } 
        } 
        return redirect('/'); 
    } 
 
    public function confirm($id) 
    { 
        $kategori = KategoriModel::find($id); 
        return view('kategori.confirm', [ 
            'kategori' => $kategori 
        ]); 
    } 


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax() || $request->wantsJson()){ 
            $check = KategoriModel::find($id); 
            if($check){ // jika sudah ditemuikan 
               try{ // try, coba hapus data ini 
                    $check->delete(); // hapus 
                 
                    return response()->json([ 
                        'status' => true, 
                        'message' => 'Data berhasil dihapus' 
                    ]); 
                }catch(\Exception $e){ // jika gagal hapus, tampilkan pesan error 
                    return response()->json([ 
                        'status' => false, 
                        'message' => 'Data gagal dihapus. Data Kategori ini masih digunakan di tabel lain.' 
                    ]); 
                } 
 
            }else{ 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Data tidak ditemukan' 
                ]); 
            } 
        } 
        return redirect('/'); 
    } 
    }
