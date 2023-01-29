<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::create([
            'nik' => '210100024',
            'name' => 'SARI DIYAH PALUPY',
            'email' => 'sari.palupy@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 2
        ]);

        $user1->assignRole('admin');

        $user2 = User::create([
            'nik' => '110900055',
            'name' => 'HERMANSYAH CHANIAGO',
            'email' => 'hermansyah.chaniago@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 2
        ]);

        $user2->assignRole('pic');

        $user3 = User::create([
            'nik' => '60500014',
            'name' => 'YUDHA AGUS TRI BASUKI',
            'email' => 'yudha.tbasuki@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 1
        ]);

        $user3->assignRole('depthead pic');

        $user4 = User::create([
            'nik' => '120200010',
            'name' => 'AGUNG JOKO SUPRIHANTO',
            'email' => 'agung.joko@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 2
        ]);

        $user4->assignRole('svp system');

        $user5 = User::create([
            'nik' => '130100005',
            'name' => 'AMBAR KUSUMO NUGROHO',
            'email' => 'ambar.nugroho@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 4
        ]);

        $user5->assignRole('mnf');

        $user6 = User::create([
            'nik' => '81000038',
            'name' => 'AGUS FIRMANSYAH',
            'email' => 'agus.firmansyah@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 7
        ]);

        $user6->assignRole('mnf');

        $user7 = User::create([
            'nik' => '180600122',
            'name' => 'BERNADHETA RISMISARI HANDAYANI',
            'email' => 'bernadheta.handayani@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 8
        ]);

        $user7->assignRole('mnf');

        $user8 = User::create([
            'nik' => '50700014',
            'name' => 'DIDIK BUDIARTO',
            'email' => 'didik.budiarto@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 3
        ]);

        $user8->assignRole('mnf');

        $user9 = User::create([
            'nik' => '100300009',
            'name' => 'NAZARUDIN RACHMAN SIDIK',
            'email' => 'nazarudin.rachman@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 9
        ]);

        $user9->assignRole('mnf');

        $user10 = User::create([
            'nik' => '150600127',
            'name' => 'YOPPY SUKMANDAR',
            'email' => 'yoppy.sukmandar@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 5
        ]);

        $user10->assignRole('mnf');

        $user11 = User::create([
            'nik' => '70400065',
            'name' => 'Marleny Patandung',
            'email' => 'marleny.patandung@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 6
        ]);

        $user11->assignRole('mnf');

        $user12 = User::create([
            'nik' => '123456',
            'name' => 'JOJON DARSONO YOGA JAYA',
            'email' => 'jojon.darsono@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 12
        ]);

        $user12->assignRole('document control');

        $user13 = User::create([
            'nik' => '100992711',
            'name' => 'SITI RIZKIANA NURANNISA',
            'email' => 'siti.nurannisa@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 7
        ]);

        $user13->assignRole('mr & food safety team');

        $user14 = User::create([
            'nik' => '61200039',
            'name' => 'SUNGATNO',
            'email' => 'sungatno.hadi@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 7
        ]);

        $user14->assignRole('mr & food safety team');

        $user15 = User::create([
            'nik' => '120292511',
            'name' => 'AHMAD SAHRONI',
            'email' => 'ahmad.sahroni@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 4
        ]);

        $user15->assignRole('mr & food safety team');

        $user16 = User::create([
            'nik' => '70100001',
            'name' => 'ADI SETIAHADI',
            'email' => 'adi.setiahadi@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 4
        ]);

        $user16->assignRole('mr & food safety team');

        $user17 = User::create([
            'nik' => '141092923',
            'name' => 'FITRIYANI',
            'email' => 'fitriyani.wijaya@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 8
        ]);

        $user17->assignRole('mr & food safety team');

        $user18 = User::create([
            'nik' => '150791709',
            'name' => 'HAPPY SUGESTIE PRAHARA',
            'email' => 'happy.sugestie@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 8
        ]);

        $user18->assignRole('mr & food safety team');

        $user19 = User::create([
            'nik' => '120292517',
            'name' => 'YUANITA JOHAN',
            'email' => 'yuanita.johan@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 9
        ]);

        $user19->assignRole('mr & food safety team');

        $user20 = User::create([
            'nik' => '140792916',
            'name' => 'IRPAN HIDAYAT PAMIL',
            'email' => 'irpan.hidayat.pamil@kalbenutritionals.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 9
        ]);

        $user20->assignRole('mr & food safety team');
    }
}
