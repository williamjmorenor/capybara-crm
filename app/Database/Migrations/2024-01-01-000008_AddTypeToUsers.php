<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTypeToUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('users', [
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['internal', 'client'],
                'default'    => 'internal',
                'after'      => 'role',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('users', 'type');
    }
}
