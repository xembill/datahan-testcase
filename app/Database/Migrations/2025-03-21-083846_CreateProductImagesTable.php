<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */

// Entry Point (CreateProductImagesTable)

/**
 * Ürün görselleri tablosu tanımlamaları.
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductImagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'product_id' => ['type' => 'INT'],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_main'    => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
//        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_images');
    }

    public function down()
    {
        $this->forge->dropTable('product_images');
    }

}
