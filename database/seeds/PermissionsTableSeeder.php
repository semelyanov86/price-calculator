<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'scan_queue_create',
            ],
            [
                'id'    => '18',
                'title' => 'scan_queue_edit',
            ],
            [
                'id'    => '19',
                'title' => 'scan_queue_show',
            ],
            [
                'id'    => '20',
                'title' => 'scan_queue_delete',
            ],
            [
                'id'    => '21',
                'title' => 'scan_queue_access',
            ],
            [
                'id'    => '22',
                'title' => 'scan_proxy_create',
            ],
            [
                'id'    => '23',
                'title' => 'scan_proxy_edit',
            ],
            [
                'id'    => '24',
                'title' => 'scan_proxy_show',
            ],
            [
                'id'    => '25',
                'title' => 'scan_proxy_delete',
            ],
            [
                'id'    => '26',
                'title' => 'scan_proxy_access',
            ],
            [
                'id'    => '27',
                'title' => 'user_data_create',
            ],
            [
                'id'    => '28',
                'title' => 'user_data_edit',
            ],
            [
                'id'    => '29',
                'title' => 'user_data_show',
            ],
            [
                'id'    => '30',
                'title' => 'user_data_delete',
            ],
            [
                'id'    => '31',
                'title' => 'user_data_access',
            ],
            [
                'id'    => '32',
                'title' => 'scan_data_cellular_create',
            ],
            [
                'id'    => '33',
                'title' => 'scan_data_cellular_edit',
            ],
            [
                'id'    => '34',
                'title' => 'scan_data_cellular_show',
            ],
            [
                'id'    => '35',
                'title' => 'scan_data_cellular_delete',
            ],
            [
                'id'    => '36',
                'title' => 'scan_data_cellular_access',
            ],
            [
                'id'    => '37',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
