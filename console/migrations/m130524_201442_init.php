<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 ENGINE=InnoDB';
        }

        $this->createUser($tableOptions);
        $this->createDistrict($tableOptions);
        $this->createBuilding($tableOptions);
        $this->createWorker($tableOptions);
        $this->createFeedback($tableOptions);
        $this->createImage($tableOptions);
        $this->createNotification($tableOptions);
        $this->createReservation($tableOptions);
        $this->createAdvertisement($tableOptions);
        $this->createSession($tableOptions);
    }

    private function createUser($tableOptions)
    {
        $this->createTable('user', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string(64)->notNull(),
            'email'                 => $this->string(128)->notNull()->unique(),
            'phone'                 => $this->string(16)->notNull(),
            'plate_number'          => $this->string(32),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull(),
            'password_reset_token'  => $this->string()->unique(),
            'status'                => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at'            => $this->integer()->notNull(),
            'updated_at'            => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createDistrict($tableOptions)
    {
        $this->createTable('district', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
        ], $tableOptions);

        $this->insert('district', [
            'name'  => '1',
        ]);

        $this->insert('district', [
            'name'  => '2',
        ]);

        $this->insert('district', [
            'name'  => '3',
        ]);

        $this->insert('district', [
            'name'  => 'Binh Thanh',
        ]);

        return;
    }

    private function createBuilding($tableOptions)
    {
        $this->createTable('building', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
            'district_id'       => $this->integer()->notNull(),
            'address'           => $this->string(64),
            'contract_start'    => $this->date()->notNull(),
            'contract_end'      => $this->date()->notNull(),
            'open_time'         => $this->time()->notNull(),
            'close_time'        => $this->time()->notNull(),
            'max_reservation'   => $this->integer()->notNull()->defaultValue(0),
            'represent_name'    => $this->string(64),
            'represent_email'   => $this->string(128),
            'represent_phone'   => $this->string(16),
            'is_ambition'       => $this->boolean()->notNull()->defaultValue(0),
            'is_deact'          => $this->boolean()->notNull()->defaultValue(0),
            'price'             => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createWorker($tableOptions)
    {
        $this->createTable('worker', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string(64)->notNull(),
            'email'                 => $this->string(128)->notNull()->unique(),
            'phone'                 => $this->string(16)->notNull(),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull(),
            'password_reset_token'  => $this->string()->unique(),
            'status'                => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at'            => $this->integer()->notNull(),
            'updated_at'            => $this->integer()->notNull(),
        ], $tableOptions);

        /*
         * Create initial admin
         * 
         * @email: tapikaadmin@am-bition.vn
         * @pass : Tap1kaADMIN
         *
         */
        $this->insert('worker', [
            'id'            => 1,
            'name'          => 'Admin',
            'email'         => 'tapikaadmin@am-bition.vn',
            'phone'         => '00000000000',
            'password_hash' => '$2y$13$VG.IE8xOshUwPidBlmc/NOMrM3i2CfPaR6EHDPSJb36j9DD9QgHAm',
            'auth_key'      => 'cei_KonvCVYvaKWoJtLfoBb8mgvNerjb',
            'created_at'    => 1470897811,
            'updated_at'    => 1470897811,
        ]);

        return;
    }

    private function createFeedback($tableOptions)
    {
        $this->createTable('feedback', [
            'id'            => $this->primaryKey(),
            'user_id'       => $this->integer()->notNull(),
            'building_id'   => $this->integer()->notNull(),
            'rates'         => $this->smallInteger(),
            'service'       => $this->smallInteger(),
            'security'      => $this->smallInteger(),
            'handling'      => $this->smallInteger(),
            'attitude'      => $this->smallInteger(),
        ], $tableOptions);

        return;
    }

    private function createImage($tableOptions)
    {
        $this->createTable('image', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string()->notNull(),
            'url'   => $this->string()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createNotification($tableOptions)
    {
        $this->createTable('notification', [
            'id'                => $this->primaryKey(),
            'user_id'           => $this->integer()->notNull(),
            'reservation_id'    => $this->integer(),
            'content'           => $this->text(),
            'send_time'         => $this->datetime()->notNull(),
            'is_read'           => $this->boolean()->notNull()->defaultValue(0),
            'image1_id'         => $this->integer(),
            'image2_id'         => $this->integer(),
            'image3_id'         => $this->integer(),
        ], $tableOptions);

        return;
    }

    private function createReservation($tableOptions)
    {
        $this->createTable('reservation', [
            'id'            => $this->primaryKey(),
            'user_id'       => $this->integer()->notNull(),
            'building_id'   => $this->integer()->notNull(),
            'status'        => $this->smallInteger()->notNull()->defaultValue(0),
            'send_time'     => $this->datetime()->notNull(),
            'reserved_time' => $this->datetime()->notNull(),
            'plate_number'  => $this->string(16)->notNull(),
            'is_feedbacked' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        return;
    }

    private function createSession($tableOptions)
    {
        $this->createTable('session', [
            'id'        => $this->char(40),
            'expire'    => $this->integer(),
            'data'      => $this->binary(),
        ], $tableOptions);

        $this->addPrimaryKey(
            $name   = 'pri-session-id',
            $table  = 'session',
            $column = 'id'
        );

        return;
    }

    private function createAdvertisement($tableOptions)
    {
        $this->createTable('advertisement', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(128)->notNull(),
            'link'          => $this->string(),
            'title'         => $this->string(),
            'address'       => $this->string(),
            'start'         => $this->date()->notNull(),
            'expire'        => $this->date()->notNull(),
            'price'         => $this->integer()->notNull(),
            'building_id'   => $this->integer()->notNull(),
            'image_id'      => $this->integer(),
        ], $tableOptions);

        return;
    }

    /*
    private function create($tableOptions)
    {
        $this->createTable('', [
            'id'                => $this->primaryKey(),
        ], $tableOptions);
    }

    */

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('advertisement');
        $this->dropTable('building');
        $this->dropTable('district');
        $this->dropTable('feedback');
        $this->dropTable('image');
        $this->dropTable('notification');
        $this->dropTable('reservation');
        $this->dropTable('session');
        $this->dropTable('worker');
    }
}
