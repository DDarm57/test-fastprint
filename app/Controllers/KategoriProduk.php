<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriProdukModel;

class KategoriProduk extends BaseController
{
    protected $k_Produk;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->k_Produk = new KategoriProdukModel();
    }
    public function index()
    {
        $kategoriProduk = $this->k_Produk->findAll();
        $api_kategoriProduk = session()->get("api_produk");
        $data_kategori = [];
        foreach ($api_kategoriProduk as $k) {
            $data_kategori[] = [
                "nama_kategori" => $k->kategori
            ];
        }
        $uniqueArray = array_map("unserialize", array_unique(array_map("serialize", $data_kategori)));
        $api_kategori = array_values($uniqueArray);

        $view_data = [
            "title" => "Kategori Produk",
            "k_produk" => $kategoriProduk,
            "api_kategori" => $api_kategori
        ];
        return view("kategori_produk/index", $view_data);
    }

    public function save_kategori()
    {
        $nama_kategori = $this->request->getVar("nama_kategori");

        $cek_kategori = $this->db->table("kategori")
            ->where("nama_kategori", $nama_kategori)
            ->get()->getRowArray();

        if ($cek_kategori) {
            session()->setFlashdata("error", "Kategori produk sudah ada");
        } else {
            $this->db->table("kategori")->insert(["nama_kategori" => $nama_kategori]);
            session()->setFlashdata("success", "Kategori produk berhasil di tambahkan");
        }

        return redirect()->to(site_url("kategoriProduk"));
    }

    public function update_kategori($id_kategori)
    {
        $nama_kategori = $this->request->getVar("nama_kategori");

        $kategori = $this->k_Produk->find($id_kategori);

        if ($nama_kategori !== $kategori["nama_kategori"]) {
            $cek_kategori = $this->db->table("kategori")->where("nama_kategori", $nama_kategori)->get()->getResultArray();
            if ($cek_kategori) {
                session()->setFlashdata("error", "Nama kategori sudah ada");
            } else {
                $this->k_Produk->update($id_kategori, ["nama_kategori" => $nama_kategori]);
                session()->setFlashdata("success", "Kategori berhasil di update");
            }
        } else {
            session()->setFlashdata("error", "Tidak ada perubahan pada data");
        }

        return redirect()->to(site_url("kategoriProduk"));
    }

    public function delete_kategori($id_kategori)
    {
        $cek_produk = $this->db->table("produk")
            ->where("kategori_id", $id_kategori)
            ->get()->getRowArray();

        if ($cek_produk) {
            session()->setFlashdata("error", "Kategori gagal di hapus. Terdapat aktifitas di dalam data produk");
        } else {
            $this->k_Produk->delete($id_kategori);
            session()->setFlashdata("success", "Kategori berhasil di hapus");
        }

        return redirect()->to(site_url("kategoriProduk"));
    }
}
