<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'         => ['type' => 'ENUM', 'constraint' => ['call', 'email', 'meeting', 'note'], 'default' => 'note'],
            'description'  => ['type' => 'TEXT'],
            'date'         => ['type' => 'DATETIME'],
            'related_type' => ['type' => 'ENUM', 'constraint' => ['lead', 'contact', 'opportunity'], 'null' => true],
            'related_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_by'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('activities');
    }

    public function down(): void
    {
        $this->forge->dropTable('activities');
    }
}
