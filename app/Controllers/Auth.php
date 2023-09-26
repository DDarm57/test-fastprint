<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use Config\Cookie;
use Config\Services;
use DateInterval;
use DateTime;

class Auth extends BaseController
{
    public function index()
    {
        //
        return view("auth/login");
    }

    public function cek_login()
    {
        $currentDateTime = new DateTime();

        $fixedPart = $this->request->getVar("username");

        // Menambahkan 1 jam
        $currentDateTime->add(new DateInterval('PT1H'));

        // Mengambil tanggal dan waktu setelah penambahan 1 jam
        $newDate = $currentDateTime->format('dmy');
        $newTime = $currentDateTime->format('H');

        // Menggabungkan bagian tetap dengan tanggal dan waktu setelah penambahan 1 jam
        $newUsername = $fixedPart . $newDate . "C" . $newTime;
        $password = $this->request->getVar("password") . "-" . date("d-m-y");

        $pWmd5 = md5($password);

        $data = [
            "username" => $newUsername,
            "password" => $pWmd5
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://recruitment.fastprint.co.id/tes/api_tes_programmer');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // dd($httpCode, $response);

        if ($httpCode == 200) {
            $data = json_decode($response);

            session()->set("log", true);
            session()->set("api_produk", $data->data);

            $view_data = [
                "log" => true,
                "pesan" => 'Login Berhasil',
                "url" => site_url("produk"),
            ];
        } else {
            $msg = json_decode($response);
            $view_data = [
                "pesan" => $msg->ket,
            ];
        }
        return json_encode($view_data);
    }

    public function logout()
    {
        session()->remove("log");
        session()->remove("api_produk");
        return redirect()->to(site_url("auth/login"));
    }
}
