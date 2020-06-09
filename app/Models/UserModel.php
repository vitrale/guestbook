<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    public function findByUsername($username)
    {
        $builder = $this->builder();

        $query = $builder->where($this->table . '.username', $username)->get();

        $result = $query->getFirstRow($this->returnType);

        $eventData = $this->trigger('afterFind', [
            'data' => $result
        ]);

        return $eventData['data'];
    }

    protected $DBGroup = 'default';

    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $returnType = 'App\Entities\User';

    protected $allowedFields = [
        'username',
        'email',
        'password'
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