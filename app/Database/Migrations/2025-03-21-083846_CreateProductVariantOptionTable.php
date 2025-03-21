<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */

// Entry Point (CreateProductVariantOptionTable)

/**
 * Ürün varyant seçenekleri tablosu tanımlamaları.
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductVariantOptionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'product_id'  => ['type' => 'INT'],
            'variant_id'  => ['type' => 'INT'],
            'option_id'   => ['type' => 'INT'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
//        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
//        $this->forge->addForeignKey('variant_id', 'variants', 'id', 'CASCADE', 'CASCADE');
//        $this->forge->addForeignKey('option_id', 'variant_options', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_variant_option');
    }

    public function down()
    {
        $this->forge->dropTable('product_variant_option');
    }

}
