<?php
namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{

    protected $DBGroup = 'default';

    protected $table = 'user_role';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'role_id'
    ];

    protected $dateFormat = 'int';

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';

    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;
}