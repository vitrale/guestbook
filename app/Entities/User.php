<?php
namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{

    public function setPassword($password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function login($password)
    {
        return password_verify($password, $this->attributes['password']);
    }

    public function hasRole($roles, $roleModel)
    {
        $roleList = $roleModel->findByUserId($this->attributes['id']);
        if (is_null($roleList)) {
            return false;
        }
        $found = false;
        for ($i = 0; $i < count($roleList) && ! $found; $i ++) {
            if (in_array($roleList[$i]->name, $roles)) {
                $found = true;
            }
        }
        return $found;
    }
}

?>