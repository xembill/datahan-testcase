<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */

// Entry Point (CreateVariantOptionsTable)

/**
 * Varyant seçenekleri tablosu tanımlamaları.
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVariantOptionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'variant_id' => ['type' => 'INT'],
            'value'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('variant_id', 'variants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('variant_options');
    }

    public function down()
    {
        $this->forge->dropTable('variant_options');
    }

}
