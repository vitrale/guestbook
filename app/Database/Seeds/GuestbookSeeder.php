<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Config\Services;
use App\Entities\User;

class GuestbookSeeder extends Seeder
{

    public function run()
    {
        $idList = array();

        $roleModel = Services::roleModel();

        $roleModel->save(array(
            'name' => 'post-read'
        ));

        $idList[] = $roleModel->getInsertID();

        $roleModel->save(array(
            'name' => 'post-write'
        ));

        $idList[] = $roleModel->getInsertID();

        $roleModel->save(array(
            'name' => 'post-admin'
        ));

        $idList[] = $roleModel->getInsertID();

        $roleList = $roleModel->find($idList);

        $user = new User();
        $user->username = 'vitrale';
        $user->email = 'vitrale@example.tld';
        $user->password = 'password';

        $userModel = Services::userModel();
        $userModel->save($user);

        $userId = $userModel->getInsertID();

        $userRoleModel = Services::userRoleModel();

        for ($i = 0; $i < count($roleList); $i ++) {
            $userRoleModel->save([
                'user_id' => $userId,
                'role_id' => $roleList[$i]->id
            ]);
        }

        $userModel = Services::userModel();

        $userModel->save($user);
    }
}