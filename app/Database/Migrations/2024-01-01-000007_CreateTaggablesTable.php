<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaggablesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tag_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'taggable_type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'taggable_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('taggables');
    }

    public function down(): void
    {
        $this->forge->dropTable('taggables');
    }
}
