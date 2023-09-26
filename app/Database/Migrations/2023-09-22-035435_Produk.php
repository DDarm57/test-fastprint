<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'harga' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'kategori_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'status_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ]);
        $this->forge->addKey('id_produk', true);

        $this->forge->createTable('produk');
    }

    public function down()
    {
        //
        $this->forge->dropTable('produk');
    }
}
