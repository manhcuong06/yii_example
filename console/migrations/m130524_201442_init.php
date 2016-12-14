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
        $this->createWorker($tableOptions);
        $this->createBanner($tableOptions);
        $this->createNewsCategory($tableOptions);
        $this->createNews($tableOptions);
        $this->createProductCategory($tableOptions);
        $this->createProduct($tableOptions);
        $this->createInvoice($tableOptions);
        $this->createInvoiceDetail($tableOptions);
        $this->createSession($tableOptions);
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
            'image'                 => $this->string(128),
            'created_at'            => $this->integer()->notNull(),
            'updated_at'            => $this->integer()->notNull(),
        ], $tableOptions);

        /*
         * Create initial admin
         *
         * @email: nguyencuong945@gmail.com
         * @pass : Tap1kaADMIN
         *
         */
        $this->insert('worker', [
            'id'            => 1,
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'phone'         => '0979000000',
            'password_hash' => '$2y$13$ZdUw.mB4DoV43cnZ3.UulO5dYTCQXs9MWOf7a/3O.D6hWS.P6sIoq',
            'auth_key'      => 'cei_KonvCVYvaKWoJtLfoBb8mgvNerjb',
            'image'         => 'user1.png',
            'created_at'    => 1470897811,
            'updated_at'    => 1470897811,
        ]);

        return;
    }

    private function createUser($tableOptions)
    {
        $this->createTable('user', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string(64)->notNull(),
            'email'                 => $this->string(128)->notNull()->unique(),
            'phone'                 => $this->string(16)->notNull(),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull(),
            'password_reset_token'  => $this->string()->unique(),
            'status'                => $this->smallInteger()->notNull()->defaultValue(10),
            'image'                 => $this->string(128),
            'created_at'            => $this->integer()->notNull(),
            'updated_at'            => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createBanner($tableOptions)
    {
        $this->createTable('banner', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
            'image'             => $this->string(128)->notNull(),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1),
            'link'              => $this->string(128),
        ], $tableOptions);

        return;
    }

    private function createNewsCategory($tableOptions)
    {
        $this->createTable('news_category', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
            'parent_id'         => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createNews($tableOptions)
    {
        $this->createTable('news', [
            'id'                => $this->primaryKey(),
            'category_id'       => $this->integer()->notNull(),
            'title'             => $this->string(64)->notNull(),
            'summary'           => $this->text()->notNull(),
            'detail'            => $this->text()->notNull(),
            'created_at'        => $this->date()->notNull(),
            'views'             => $this->integer()->notNull()->defaultValue(0),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1),
            'image'             => $this->string(128)->notNull(),
        ], $tableOptions);

        return;
    }

    private function createProductCategory($tableOptions)
    {
        $this->createTable('product_category', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
            'parent_id'         => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createProduct($tableOptions)
    {
        $this->createTable('product', [
            'id'                => $this->primaryKey(),
            'category_id'       => $this->integer()->notNull(),
            'name'              => $this->string(64)->notNull(),
            'summary'           => $this->text()->notNull(),
            'detail'            => $this->text()->notNull(),
            'price'             => $this->integer()->notNull(),
            'image'             => $this->string(128)->notNull(),
            'is_new'            => $this->boolean()->notNull()->defaultValue(1),
            'views'             => $this->integer()->notNull()->defaultValue(0),
            'created_at'        => $this->date()->notNull(),
            'status'            => $this->smallInteger()->notNull()->defaultValue(1),
            'discount'          => $this->text(),
        ], $tableOptions);

        return;
    }

    private function createInvoice($tableOptions)
    {
        $this->createTable('invoice', [
            'id'                => $this->primaryKey(),
            'name'              => $this->string(64)->notNull(),
            'gender'            => $this->boolean(),
            'birthday'          => $this->date()->notNull(),
            'email'             => $this->string(128)->notNull(),
            'address'           => $this->string(128)->notNull(),
            'phone'             => $this->string(16)->notNull(),
            'created_at'        => $this->date()->notNull(),
            'status'            => $this->boolean()->notNull()->defaultValue(0),
            'remark'            => $this->text(),
            'total'             => $this->integer()->notNull(),
        ], $tableOptions);

        return;
    }

    private function createInvoiceDetail($tableOptions)
    {
        $this->createTable('invoice_detail', [
            'id'                => $this->primaryKey(),
            'invoice_id'        => $this->integer()->notNull(),
            'product_id'        => $this->integer()->notNull(),
            'quantity'          => $this->integer()->notNull(),
            'price'             => $this->integer()->notNull(),
            'total'             => $this->integer()->notNull(),
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

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('worker');
        $this->dropTable('banner');
        $this->dropTable('news_category');
        $this->dropTable('news');
        $this->dropTable('product_category');
        $this->dropTable('product');
        $this->dropTable('invoice');
        $this->dropTable('invoice_detail');
        $this->dropTable('session');
    }
}
