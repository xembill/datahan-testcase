<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */

// Entry Point (CreateVariantsTable)

/**
 * Ürün varyantları tablosu tanımlamaları.
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('variants');
    }

    public function down()
    {
        $this->forge->dropTable('variants');
    }

}
