<?php
namespace Config;

use CodeIgniter\Config\Services as CoreServices;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\RoleModel;
use App\Models\PostModel;
require_once SYSTEMPATH . 'Config/Services.php';

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends CoreServices
{

    public static function userModel($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userModel');
        }
        return new UserModel();
    }

    public static function roleModel($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('roleModel');
        }
        return new RoleModel();
    }

    public static function userRoleModel($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userRoleModel');
        }
        return new UserRoleModel();
    }

    public static function postModel($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('postModel');
        }
        return new PostModel();
    }
}
