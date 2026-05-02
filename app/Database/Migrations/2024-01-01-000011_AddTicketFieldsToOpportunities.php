<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTicketFieldsToOpportunities extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('opportunities', [
            'ticket_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'contact_id',
            ],
            'origin' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'ticket_id',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('opportunities', 'ticket_id');
        $this->forge->dropColumn('opportunities', 'origin');
    }
}
