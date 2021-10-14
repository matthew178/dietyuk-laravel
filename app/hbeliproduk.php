<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hbeliproduk extends Model
{
    protected $table= 'hbeliproduk';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable= [
        'id',
        'pemesan',
		'konsultan',
		'alamat',
		'waktubeli',
        'total',
        'status',
        'nomorresi',
        'kurir',
        'service',
        'keterangan',
        'nopesanan',
        'totalhargaproduk',
        'ongkir'
    ];
    public $timestamps= false;

    public function getTransaksiProdukKonsultan($id){
        return hbeliproduk::select("hbeliproduk.*")
                            ->where("konsultan","=",$id)
                            ->where("status","=",0)
                            ->orWhere("konsultan","=",$id)
                            ->where("status","=",1)
                            ->get();
    }

    public function getTransaksiPacking($id){
        return hbeliproduk::select("hbeliproduk.*","member.nama","alamat.penerima","alamat.nomortelepon","kota.nama_kota","kota.provinsi","alamat.alamat_detail")
                            ->join("member","member.id","=","hbeliproduk.pemesan")
                            ->join("alamat","alamat.id","=","hbeliproduk.alamat")
                            ->join("kota","kota.id_kota","=","alamat.kota")
                            ->where("hbeliproduk.konsultan","=",$id)
                            ->where("hbeliproduk.status","=",0)
                            ->get();
    }

    public function getTransaksiProdukKirim($id){
        return hbeliproduk::select("hbeliproduk.*","member.nama","alamat.penerima","alamat.nomortelepon","kota.nama_kota","kota.provinsi","alamat.alamat_detail")
                            ->join("member","member.id","=","hbeliproduk.pemesan")
                            ->join("alamat","alamat.id","=","hbeliproduk.alamat")
                            ->join("kota","kota.id_kota","=","alamat.kota")
                            ->where("hbeliproduk.konsultan","=",$id)
                            ->where("hbeliproduk.status","=",1)
                            ->get();
    }

    public function getTransaksiProdukSelesai($id){
        return hbeliproduk::select("hbeliproduk.*","member.nama","alamat.penerima","alamat.nomortelepon","kota.nama_kota","kota.provinsi","alamat.alamat_detail")
                            ->join("member","member.id","=","hbeliproduk.pemesan")
                            ->join("alamat","alamat.id","=","hbeliproduk.alamat")
                            ->join("kota","kota.id_kota","=","alamat.kota")
                            ->where("hbeliproduk.konsultan","=",$id)
                            ->where("hbeliproduk.status","=",2)
                            ->Orwhere("hbeliproduk.konsultan","=",$id)
                            ->where("hbeliproduk.status","=",3)
                            ->get();
    }

    public function getDetailHeader($idbeli){
        return hbeliproduk::select("hbeliproduk.*","member.nama","alamat.penerima","alamat.nomortelepon","kota.nama_kota","kota.provinsi","alamat.alamat_detail")
                            ->join("member","member.id","=","hbeliproduk.pemesan")
                            ->join("alamat","alamat.id","=","hbeliproduk.alamat")
                            ->join("kota","kota.id_kota","=","alamat.kota")
                            ->where("hbeliproduk.id","=",$idbeli)
                            ->get();
    }
}
