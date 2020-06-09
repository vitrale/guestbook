<?php
namespace App\Entities;

use CodeIgniter\Entity;

class Post extends Entity
{

    protected $attributes = [
        'id' => null,
        'title' => null,
        'message' => null,
        'user_id' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null
    ];

    protected $datamap = [
        'userId' => 'user_id', 
        'createdAt' => 'created_at', 
        'updatedAt' => 'updated_at', 
        'deletedAt' => 'deleted_at'
    ];
}

?>