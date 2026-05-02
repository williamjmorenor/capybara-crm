<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketMessagesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ticket_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'author_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'author_type' => ['type' => 'ENUM', 'constraint' => ['user', 'client'], 'default' => 'user'],
            'message'     => ['type' => 'TEXT'],
            'type'        => ['type' => 'ENUM', 'constraint' => ['public', 'private'], 'default' => 'public'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('ticket_id');
        $this->forge->addForeignKey('ticket_id', 'tickets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ticket_messages');
    }

    public function down(): void
    {
        $this->forge->dropTable('ticket_messages');
    }
}
