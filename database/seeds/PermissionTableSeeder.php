<?php

use Illuminate\Database\Seeder;
use Kodeine\Acl\Models\Eloquent\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $permission = new Permission();
			$permUser = $permission->create([ 
			    'name'        => 'user',
			    'slug'        => [          // pass an array of permissions.
			        'create'     => true,
			        'view'       => true,
			        'update'     => true,
			        'delete'     => true,
			        'view.phone' => true
			    ],
			    'description' => 'manage user permissions'
			]);

			$permission = new Permission();
			$permPost = $permission->create([ 
			    'name'        => 'post',
			    'slug'        => [          // pass an array of permissions.
			        'create'     => true,
			        'view'       => true,
			        'update'     => true,
			        'delete'     => true,
			    ],
			    'description' => 'manage post permissions'
			]);
    }
}
