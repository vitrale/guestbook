<?php
namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{

    public function findAllWithUser()
    {
        $database = $this->db;

        $query = $database->query("SELECT L.id as id, L.title as title, L.message as message, L.user_id as userId, R.username as username FROM POST L INNER JOIN USER R ON L.USER_ID = R.ID WHERE R.deleted_at IS NULL ORDER BY L.id DESC");

        $result = $query->getResult();

        $eventData = $this->trigger('afterFind', [
            'data' => $result
        ]);

        return $eventData['data'];
    }

    protected $DBGroup = 'default';

    protected $table = 'post';

    protected $primaryKey = 'id';

    protected $returnType = 'App\Entities\Post';

    protected $allowedFields = [
        'title',
        'message',
        'user_id'
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