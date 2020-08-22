<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Dokter;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Crypt;



class DokterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth',['only' => [ 
        //     'getall',
        //     'verifikasiktp'
        // ]
        // ]);

    }

    public function adddokter(Request $request){
        $data=[
            'nama_dokter'=>$request['nama_dokter'],
            'spesialis'=>$request['spesialis'],
            'harga_konsul'=>$request['harga_konsul'],
            'foto_dokter'=>$request['foto_dokter'],
        ];

        $id_dokter = IdGenerator::generate([
            'table' => 'dokter', 
            'field'=>'id_dokter',
            'length' => 10, 
            'prefix' => 'DOK-'
        ]);

        $namafilefotodokter = "FotoDokter_".$id_dokter.".jpg";
        $destinationPath = public_path('File/FotoDokter/');
        $path = $request->file('foto_dokter')->move($destinationPath,$namafilefotodokter);
        $urlfotodokter = $destinationPath.$namafilefotodokter;


        $dokter = Dokter::create([
            'id_dokter'=>$id_dokter,
            'nama_dokter'=>$request['nama_dokter'],
            'spesialis'=>$request['spesialis'],
            'harga_konsul'=>$request['harga_konsul'],
            'foto_dokter'=>$urlfotodokter,
        ]);

        return response()->json([
            'status' => 'Data dokter berhasil ditambah', 
            'response' => $dokter
        ], 200);
    }

    public function getdokter(){
        $data =  Dokter::all();
        return response()->json([
            'status' => 'Data dokter berhasil diambil', 
            'response' => $data
        ], 200);
    }

}
