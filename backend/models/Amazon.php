<?php

namespace backend\models;

use Yii;
use common\models\Product;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;

class Amazon
{
    /**
     * Get all Products from DB and then set (update) Product Info for each of them
     * @param string $mode - get all Products || get new Products
     * @return bool
     */
    public function updateProductsInfo($mode = '')
    {
        // get list of Products by $mode
        if(empty($mode))
            $products = Product::find()->asArray()->all(); // all
        else
            $products = Product::find()->where(['title' => null])->orWhere(['title' => ''])->asArray()->all(); // new

        if(!empty($products)){
            foreach ($products as $product) {
                $this->setProductInfo($product['asin']);
            }
            return true;
        }
        return false;
    }

    /**
     * Get ItemLookup result for one Product, clean him and update current Product
     * @param string $asin - Amazon Product ASIN
     * @return bool
     */
    public function setProductInfo($asin)
    {
        $productInfo = $this->getItemLookup($asin);
        if(!empty($productInfo['Items']['Item'])){
            $product = Product::find()->where(['asin' => $asin])->one();
            $product->url = ArrayHelper::getValue($productInfo, 'Items.Item.DetailPageURL', '');
            $product->title = ArrayHelper::getValue($productInfo, 'Items.Item.ItemAttributes.Title', '');
            $product->formatted_price = ArrayHelper::getValue($productInfo, 'Items.Item.ItemAttributes.ListPrice.FormattedPrice', '');
            $product->ean = ArrayHelper::getValue($productInfo, 'Items.Item.ItemAttributes.EAN', '');
            $product->brand = ArrayHelper::getValue($productInfo, 'Items.Item.ItemAttributes.Brand', '');
            $product->picture = ArrayHelper::getValue($productInfo, 'Items.Item.SmallImage.URL', '');
            $product->update();
            return true;
        }
        else
            return false;
    }

    /**
     * AWS API ItemLookup Operation Query
     * FAQ: http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemLookup.html
     *
     * @param $asin
     * @return array|mixed
     */
    public function getItemLookup($asin)
    {
        $return = [];
        $requestData = [
            'Operation' => 'ItemLookup',
            'ItemId' => $asin,
            'ResponseGroup' => 'Images,Medium',
        ];
        $requestUri = $this->awsSignedRequest(
            Yii::$app->params['AmazonRegion'],
            $requestData,
            Yii::$app->params['AWSAccessKeyId'],
            Yii::$app->params['AWSSecretKey'],
            Yii::$app->params['AssociateTag']
        );
        if(!empty($requestUri)){
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl($requestUri)
                ->send();
            if($response->isOk){
                $responseData = $response->getData();
                $return = (!empty($responseData)) ? $responseData : $return;
            }
        }
        return $return;
    }

    /**
     * Make correct request URL for Amazon API query
     * @param string $region - the Amazon(r) region (ca,com,co.uk,de,fr,co.jp)
     * @param array $params - an array of parameters, eg.:
     *                          array(
     *                              "Operation"=>"ItemLookup",
     *                               "ItemId"=>"B000X9FLKM",
     *                               "ResponseGroup"=>"Small");
     * @param string $public_key - your "Access Key ID"
     * @param string $private_key - your "Secret Access Key"
     * @param null $associate_tag - AWS AssociateTag string
     * @param string $version - AWS API version
     * @return string
     */
    public function awsSignedRequest($region, $params, $public_key, $private_key, $associate_tag=NULL, $version='2011-08-01')
    {
        // base parameters
        $method = 'GET';
        $host = 'webservices.amazon.'.$region;
        $uri = '/onca/xml';

        // additional parameters
        $params['Service'] = 'AWSECommerceService';
        $params['AWSAccessKeyId'] = $public_key;
        // GMT timestamp
        $params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
        // API version
        $params['Version'] = $version;
        if ($associate_tag !== NULL) {
            $params['AssociateTag'] = $associate_tag;
        }

        // sort the parameters
        ksort($params);

        // create the canonicalized query
        $canonicalized_query = array();
        foreach ($params as $param=>$value)
        {
            $param = str_replace('%7E', '~', rawurlencode($param));
            $value = str_replace('%7E', '~', rawurlencode($value));
            $canonicalized_query[] = $param.'='.$value;
        }
        $canonicalized_query = implode('&', $canonicalized_query);

        // create the string to sign
        $string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;

        // calculate HMAC with SHA256 and base64-encoding
        $signature = base64_encode(hash_hmac('sha256', $string_to_sign, $private_key, TRUE));

        // encode the signature for the request
        $signature = str_replace('%7E', '~', rawurlencode($signature));

        // create request
        $request = 'http://'.$host.$uri.'?'.$canonicalized_query.'&Signature='.$signature;

        return $request;
    }
}