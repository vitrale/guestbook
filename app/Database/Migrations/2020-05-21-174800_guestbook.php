<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guestbook extends Migration
{

    public function up()
    {
        // role table
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'unique' => true
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'updated_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'deleted_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            )
        ));
        $this->forge->addKey('id', true);
        $this->forge->createTable('role', true);
        // user table
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
                'unique' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'unique' => true
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'updated_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'deleted_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            )
        ));
        $this->forge->addKey('id', true);
        $this->forge->createTable('user', true);
        // user_role table
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'updated_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'deleted_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            )
        ));
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'role', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('user_role', true);
        // post table
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ),
            'message' => array(
                'type' => 'TEXT',
                'null' => true
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ),
            'created_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'updated_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ),
            'deleted_at' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            )
        ));
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->createTable('post', true);
    }

    // --------------------------------------------------------------------
    public function down()
    {
        $this->forge->dropTable('user_role');
        $this->forge->dropTable('post');
        $this->forge->dropTable('role');
        $this->forge->dropTable('user');
    }
}
