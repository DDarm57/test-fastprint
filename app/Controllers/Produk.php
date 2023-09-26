<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $db;
    protected $produkModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->produkModel = new ProdukModel();
    }
    public function index()
    {
        //
        $count_produk = $this->db->table("produk")->countAllResults();
        $count_kategori = $this->db->table("kategori")->countAllResults();
        $count_bisaDijual = $this->db->table("produk")
            ->join("status", "status.id_status = produk.status_id")->where("nama_status", "bisa dijual")
            ->countAllResults();
        $count_tidakDijual = $this->db->table("produk")
            ->join("status", "status.id_status = produk.status_id")->where("nama_status", "tidak bisa dijual")
            ->countAllResults();
        $data = [
            "jml_produk" => $count_produk,
            "jml_kategori" => $count_kategori,
            "jml_bisaDijual" => $count_bisaDijual,
            "jml_tidakBisaDijual" => $count_tidakDijual
        ];

        $view_data = [
            "title" => "Home",
            "jml_data" => $data
        ];
        return view("produk/index", $view_data);
    }

    public function data_produk()
    {
        $status = $this->db->table("status")->get()->getResultArray();

        $seacrh = $this->request->getVar("search");
        if (isset($seacrh)) {
            $data_produk = $this->db->table("produk")
                ->join("kategori", "kategori.id_kategori = produk.kategori_id")
                ->join("status", "status.id_status = produk.status_id")
                ->where("status_id", $seacrh)
                ->get()->getResultArray();
        } else {
            $data_produk = $this->db->table("produk")
                ->join("kategori", "kategori.id_kategori = produk.kategori_id")
                ->join("status", "status.id_status = produk.status_id")
                ->get()->getResultArray();
        }

        $view_data = [
            "title" => "Data Produk",
            "produk" => $data_produk,
            "status" => $status
        ];
        return view("produk/data_produk", $view_data);
    }

    public function create_produk()
    {
        $produk = session()->get("api_produk");
        // $data_produk = [];
        // foreach ($produk as $row) {
        //     if ($row->status == "bisa dijual") {
        //         $data_produk[] = [
        //             "id_produk" => $row->nama_produk,
        //             "kategori" => $row->kategori,
        //             "harga" => $row->harga,
        //             "status" => $row->status
        //         ];
        //     }
        // }
        // dd($produk);
        $kategori = $this->db->table("kategori")->get()->getResultArray();
        $status = $this->db->table("status")->get()->getResultArray();

        $view_data = [
            "title" => "Tambah Produk",
            "produk" => $produk,
            "kategori" => $kategori,
            "status" => $status
        ];

        return view("produk/create_produk", $view_data);
    }

    public function save_produk()
    {
        $nama_produk = $this->request->getVar("nama_produk");
        $harga = $this->request->getVar("harga");

        //==================================
        //   jika input getdata dari api  //
        //==================================
        $nama_kategori = $this->request->getVar("kategori");
        if (isset($nama_kategori)) {
            $kategori_produk = $this->db->table("kategori")
                ->where("nama_kategori", $nama_kategori)
                ->get()->getRowArray();
            if ($kategori_produk) {
                $kategori_id = $kategori_produk["id_kategori"];
            } else {
                //Jika kategori belum ada di db tambahkan dari api
                $new_kategori = $this->db->table("kategori")->insert(["nama_kategori" => $nama_kategori]);
                $msg = "Kategori baru";
                $kategori_id = $this->db->insertID();
            }
        } else {
            $kategori_id = $this->request->getVar("kategori_id");
        }
        //==================================

        $status_id = $this->request->getVar("status_id");

        $cek_produk = $this->db->table("produk")->where(
            ["nama_produk" => $nama_produk, "harga" => $harga]
        )->get()->getRowArray();

        if ($cek_produk) {
            session()->setFlashdata('error', 'Data produk gagal ditambahkan. Produk sudah ada');
        } else {
            $this->produkModel->insert([
                "nama_produk" => $nama_produk,
                "harga" => $harga,
                "kategori_id" => $kategori_id,
                "status_id" => $status_id
            ]);
            session()->setFlashdata('success', 'Data produk ' . (isset($msg) ? $msg . " dan " : "") . 'berhasil ditambahkan');
        }

        return redirect()->to(site_url('produk/data_produk'));
    }

    public function edit_produk($id_produk)
    {
        $produk = $this->produkModel->find($id_produk);

        $kategori = $this->db->table("kategori")->get()->getResultArray();
        $status = $this->db->table("status")->get()->getResultArray();

        $view_data = [
            "title" => "Edit produk",
            "produk" => $produk,
            "kategori" => $kategori,
            "status" => $status
        ];

        return view("produk/edit_produk", $view_data);
    }

    public function update_produk($id_produk)
    {
        $nama_produk = $this->request->getVar("nama_produk");
        $harga = $this->request->getVar("harga");
        $kategori_id = $this->request->getVar("kategori_id");
        $status_id = $this->request->getVar("status_id");

        $produk = $this->produkModel->find($id_produk);

        if ($nama_produk !== $produk["nama_produk"] || $harga !== $produk["harga"] || $kategori_id !== $produk["kategori_id"] || $status_id !== $produk["status_id"]) {
            $cek_produk = $this->db->table("produk")
                ->where("nama_produk", $nama_produk)
                ->where("status_id", $status_id)
                ->where("harga", $harga)
                ->get()->getResultArray();
            if ($cek_produk) {
                session()->setFlashdata("error", "Data produk dengan nama produk : " . $nama_produk . " harga : " . $harga . " sudah ada di database");
            } else {
                $data = [
                    "nama_produk" => $nama_produk,
                    "harga" =>  $harga,
                    "kategori_id" => $kategori_id,
                    "status_id" => $status_id
                ];
                $this->produkModel->update($id_produk, $data);
                session()->setFlashdata("success", "Data produk berhasil di update");
            }
        } else {
            session()->setFlashdata("error", "Tidak ada perubahan pada data");
        }

        return redirect()->to(site_url('produk/data_produk'));
    }

    public function delete_produk($id_produk)
    {
        $this->produkModel->delete($id_produk);

        session()->setFlashdata("success", "Data produk berhasil di hapus");
        return redirect()->to(site_url('produk/data_produk'));
    }
}
