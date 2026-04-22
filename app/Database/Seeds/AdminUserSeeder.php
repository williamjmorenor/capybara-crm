<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'name'       => 'Admin User',
            'email'      => 'admin@crm.local',
            'password'   => password_hash('Admin1234!', PASSWORD_BCRYPT),
            'role'       => 'admin',
            'active'     => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Only insert if not exists
        $existing = $this->db->table('users')->where('email', 'admin@crm.local')->get()->getRow();
        if (! $existing) {
            $this->db->table('users')->insert($data);
        }
    }
}
