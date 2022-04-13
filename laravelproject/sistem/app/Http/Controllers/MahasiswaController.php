<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Mahasiswa;
use Redirect;
use Session;
use Image;
use Excel;


class MahasiswaController extends Controller
{
    public function index()
    {
    	$data = Mahasiswa::paginate(5);
    	return view('mahasiswa',compact('data'));
    }

    public function cari(Request $request)
    {
        $data = Mahasiswa::where('nama','LIKE','%'.$request->cari.'%')->orwhere('nim','LIKE','%'.$request->cari.'%')->paginate(5);
        return view('mahasiswa-cari',compact('data'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nim' => 'unique:tb_mahasiswa',
            'nama' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
            'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx',
        ]
    );

        $file = $request->file('foto');
        $name = 'FT'.date('Ymdhis').'.'.$request->file('foto')->getClientOriginalExtension();

        $resize_foto = Image::make($file->getRealPath());
        $resize_foto->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
        })->save('images/foto/'.$name);

        $dokumen = $request->file('dokumen');
        $nama_dokumen = 'FT'.date('Ymdhis').'.'.$request->file('dokumen')->getClientOriginalExtension();
        $dokumen->move('dokumen/',$nama_dokumen);

        $data = new Mahasiswa();
        $data->nim = $request->nim;
        $data->foto = $name;
        $data->nama = $request->nama;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->program_studi = $request->program_studi;
        $data->dokumen = $nama_dokumen;
        $data->save();
        Session::flash('sukses','Data berhasil di simpan');
        return Redirect('/mahasiswa');
    }

    public function edit(Request $request, $id)
    {
        $data = Mahasiswa::where('nim',$id)->first();
        return view('mahasiswa-edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Mahasiswa::where('nim',$id)->first();
        $data->nim = $request->nim;
        $data->nama = $request->nama;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->program_studi = $request->program_studi;
        $data->save();
        Session::flash('sukses','Data berhasil di update');
        return Redirect('/mahasiswa');
    }

    public function hapus(Request $request, $id)
    {
        $data = Mahasiswa::where('nim',$id)->first();
        unlink('images/foto/'.$data->foto);
        $data->delete();
        Session::flash('sukses','Data berhasil di hapus');
        return Redirect('/mahasiswa');
    }

    public function hapuschecklist(Request $request, $id)
    {
        if (isset($request->hapus_data)) {
            $id_checklist = $_POST['nim_hapus'];
            foreach ($id_checklist as $id) {
                $data = Mahasiswa::where('nim',$id);
                
                $data->delete();
            }
        }
        Session::flash('sukses','Data berhasil di hapus');
        return Redirect('/mahasiswa');

    }

    public function download()
    {
        return Excel::download(new MahasiswaExport, 'Data Mahasiswa.xlsx');
    }

    public function upload(Request $request)
    {
        Excel::import(new MahasiswaImport, $request->data_mahasiswa);
        Session::flash('sukses','Data berhasil di upload');
        return Redirect('/mahasiswa');
    }
}
