<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Andi Pratama',   'member_code' => 'MBR-001', 'phone' => '081234567801', 'address' => 'Karawang Barat'],
            ['name' => 'Budi Santoso',   'member_code' => 'MBR-002', 'phone' => '081234567802', 'address' => 'Karawang Timur'],
            ['name' => 'Citra Lestari',  'member_code' => 'MBR-003', 'phone' => '081234567803', 'address' => 'Telukjambe'],
            ['name' => 'Dewi Anggraini', 'member_code' => 'MBR-004', 'phone' => '081234567804', 'address' => 'Cikampek'],
            ['name' => 'Eko Prasetyo',   'member_code' => 'MBR-005', 'phone' => '081234567805', 'address' => 'Rengasdengklok'],
        ];

        foreach ($members as $member) {
            Member::firstOrCreate(['member_code' => $member['member_code']], $member);
        }
    }
}