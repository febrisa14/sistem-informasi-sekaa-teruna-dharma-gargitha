<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kas;
use DB;
use App\Models\Baju;
use App\Models\Order;
use App\Models\User;

class CetakLaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('bendahara');
    }

    public function cetakFormKas()
    {
        return view('admin/kas/laporan',[
            'title' => 'Laporan Kas | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function cetakLaporanKas($tglawal, $tglakhir)
    {
        $pemasukan = DB::table('kas')
        ->where('tgl_transaksi', '>=', $tglawal)->where('tgl_transaksi', '<=', $tglakhir)
        // ->whereBetween('tgl_transaksi',[$tglawal, $tglakhir])
        ->where('type','Pemasukan')
        ->get();

        $pengeluaran = DB::table('kas')
        ->where('tgl_transaksi', '>=', $tglawal)->where('tgl_transaksi', '<=', $tglakhir)
        ->where('type','Pengeluaran')
        ->get();

        $pemasukanTotal = DB::table('kas')
        ->where('tgl_transaksi', '>=', $tglawal)->where('tgl_transaksi', '<=', $tglakhir)
        // ->whereBetween('tgl_transaksi',[$tglawal, $tglakhir])
        ->where('type','Pemasukan')
        ->sum('nominal');

        $pengeluaranTotal = DB::table('kas')
        ->where('tgl_transaksi', '>=', $tglawal)->where('tgl_transaksi', '<=', $tglakhir)
        ->where('type','Pengeluaran')
        ->sum('nominal');

        $saldoKas = $pemasukanTotal - $pengeluaranTotal;
        $pemasukanSeluruh = Kas::where('type','=','Pemasukan')->sum('nominal');
        $pengeluaranSeluruh = Kas::where('type','=','Pengeluaran')->sum('nominal');
        $saldoKasTotal = $pemasukanSeluruh - $pengeluaranSeluruh;

        $KetuaSTT = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','1')
        ->first();

        $Bendahara = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','5')
        ->first();

        // $pdf = PDF::loadView('admin/kas/cetak', compact('pemasukan','pengeluaran'));

        // return $pdf->download('laporan-kas_'.now().'.pdf');

        return view('admin/kas/cetak',[
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'pemasukanTotal' => $pemasukanTotal,
            'pengeluaranTotal' => $pengeluaranTotal,
            'saldoKas' => $saldoKas,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
            'saldoKasTotal' => $saldoKasTotal,
            'KetuaSTT' => $KetuaSTT,
            'Bendahara' => $Bendahara
        ]);
    }

    public function cetakFormPemesanan()
    {
        $baju = Baju::select
            ('baju_id','nama_baju')->get();

        return view('admin/pemesanan/order/laporan',[
            'title' => 'Laporan Pemesanan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'baju' => $baju
        ]);
    }

    public function cetakLaporanPemesanan($baju_id,$status)
    {
        $pemesanan = DB::table('pemesanan')->select('users.name','anggota.jenis_kelamin','pemesanan.size','pemesanan.tgl_pesanan','pemesanan.tgl_bayar','pemesanan.status','pemesanan.total')
        ->leftJoin('anggota', 'anggota.anggota_id', '=', 'pemesanan.anggota_id')
        ->leftJoin('users', 'users.user_id', '=', 'anggota.anggota_user_id')
        ->where('baju_id', '=', $baju_id)->where('status', '=', $status)
        ->get();

        $baju = Baju::select('baju_id','nama_baju')
        ->where('baju_id',$baju_id)
        ->first();

        $total = Order::where('baju_id', '=', $baju_id)->where('status', '=', $status)->sum('total');

        $KetuaSTT = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','1')
        ->first();

        $Bendahara = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','5')
        ->first();

        // $pdf = PDF::loadView('admin/kas/cetak', compact('pemasukan','pengeluaran'));

        // return $pdf->download('laporan-kas_'.now().'.pdf');

        return view('admin/pemesanan/order/cetak',[
            'pemesanan' => $pemesanan,
            'baju' => $baju,
            'total' => $total,
            'status' => $status,
            'KetuaSTT' => $KetuaSTT,
            'Bendahara' => $Bendahara
        ]);
    }
}
