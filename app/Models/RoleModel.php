<?php
namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{

    public function findByUserId($userId)
    {
        $tmpUserId = intval($userId);

        $database = $this->db;

        $query = $database->query("SELECT R.id, R.name FROM user_role L INNER JOIN {$this->table} R ON L.role_id = R.id WHERE L.user_id = {$tmpUserId}");

        $result = $query->getResult();

        $eventData = $this->trigger('afterFind', [
            'data' => $result
        ]);

        return $eventData['data'];
    }

    public function findByNameList($nameList)
    {
        $builder = $this->builder();

        $query = $builder->whereIn($this->table . '.name', $nameList)->get();

        $result = $query->getResult($this->returnType);

        $eventData = $this->trigger('afterFind', [
            'data' => $result
        ]);

        return $eventData['data'];
    }

    protected $DBGroup = 'default';

    protected $table = 'role';

    protected $primaryKey = 'id';

    protected $returnType = 'App\Entities\Role';

    protected $allowedFields = [
        'name'
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

?>