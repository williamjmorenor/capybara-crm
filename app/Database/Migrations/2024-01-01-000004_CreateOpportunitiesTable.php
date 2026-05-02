<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOpportunitiesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'contact_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 200],
            'amount'     => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0.00],
            'status'     => ['type' => 'ENUM', 'constraint' => ['new', 'in_progress', 'negotiation', 'won', 'lost'], 'default' => 'new'],
            'close_date' => ['type' => 'DATE', 'null' => true],
            'notes'      => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('contact_id', 'contacts', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('opportunities');
    }

    public function down(): void
    {
        $this->forge->dropTable('opportunities');
    }
}
