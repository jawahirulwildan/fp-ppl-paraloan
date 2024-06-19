<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'loan_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false
            ],
            'order' => [
                'type' => 'INT',
                'null' => false,
            ],
            'period' => [
                'type' => 'INT'
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
            'start_date' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'due_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'bill_nominal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'penalty' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'default' => 0
            ],
            'payment_date' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => date('Y-m-d H:i:s')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true); // Primary key
        $this->forge->addForeignKey('loan_id', 'loans', 'id', 'CASCADE', 'CASCADE'); //foreign key loan
        $this->forge->createTable('invoice');
    }

    public function down()
    {
        $this->forge->dropTable('invoice');
    }
}
