<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170926_131147_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'asin' => $this->string(20),
            'url' => $this->string(),
            'title' => $this->string(),
            'formatted_price' => $this->string(20),
            'picture' => $this->string(),
            'ean' => $this->string(20),
            'brand' => $this->string(),
        ]);

        $this->createIndex(
            'idx-product-asin',
            'product',
            'asin',
            true
        );

        /*
        $this->createIndex(
            'idx-product-ean',
            'product',
            'ean'
        );

        $this->createIndex(
            'idx-product-brand',
            'product',
            'brand'
        );*/
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex(
            'idx-product-asin',
            'product'
        );

        /*
        $this->dropIndex(
            'idx-product-ean',
            'product'
        );

        $this->dropIndex(
            'idx-product-brand',
            'product'
        );*/

        $this->dropTable('product');
    }
}
