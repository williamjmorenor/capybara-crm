<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLeadsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'            => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'source'          => ['type' => 'ENUM', 'constraint' => ['web', 'referral', 'manual', 'other'], 'default' => 'manual'],
            'status'          => ['type' => 'ENUM', 'constraint' => ['new', 'contacted', 'qualified', 'lost'], 'default' => 'new'],
            'estimated_value' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0.00],
            'assigned_to'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'notes'           => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('leads');
    }

    public function down(): void
    {
        $this->forge->dropTable('leads');
    }
}
