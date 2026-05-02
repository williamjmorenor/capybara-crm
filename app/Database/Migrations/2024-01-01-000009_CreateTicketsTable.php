<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'description' => ['type' => 'TEXT', 'null' => true],
            'client_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'assigned_to' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['new', 'assigned', 'solved', 'closed'], 'default' => 'new'],
            'priority'    => ['type' => 'ENUM', 'constraint' => ['low', 'medium', 'high'], 'default' => 'medium'],
            'type'        => ['type' => 'ENUM', 'constraint' => ['support', 'warranty', 'incident', 'commercial'], 'default' => 'support'],
            'is_billable' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'closed_at'   => ['type' => 'DATETIME', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('client_id');
        $this->forge->addKey('assigned_to');
        $this->forge->addForeignKey('client_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('tickets');
    }

    public function down(): void
    {
        $this->forge->dropTable('tickets');
    }
}
