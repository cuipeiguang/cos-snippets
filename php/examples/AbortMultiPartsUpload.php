<?php

use Qcloud\Cos\Client;
use Qcloud\Cos\Exception\ServiceResponseException;

class AbortMultiPartsUpload
{
    private $cosClient;

    private $uploadId;
    private $eTag;
    private $versionId;

    // 初始化分片上传
    protected function initMultiUpload() {
        $cosClient = $this->cosClient;
        //.cssg-snippet-body-start:[init-multi-upload]
        try {
            $result = $cosClient->createMultipartUpload(array(
                'Bucket' => 'examplebucket-1250000000', //格式：BucketName-APPID
                'Key' => 'exampleobject',
            )); 
            // 请求成功
            print_r($result);
        } catch (\Exception $e) {
            // 请求失败
            echo($e);
        }
        
        //.cssg-snippet-body-end
    }

    // 终止分片上传任务
    protected function abortMultiUpload() {
        $cosClient = $this->cosClient;
        //.cssg-snippet-body-start:[abort-multi-upload]
        try {
            $result = $cosClient->abortMultipartUpload(array(
                'Bucket' => 'examplebucket-1250000000', //格式：BucketName-APPID
                'Key' => 'exampleobject', 
                'UploadId' => 'exampleUploadId',
            )); 
            // 请求成功
            print_r($result);
        } catch (\Exception $e) {
            // 请求失败
            echo($e);
        }
        
        //.cssg-snippet-body-end
    }

	//.cssg-methods-pragma

    protected function init() {
        $secretId = "COS_SECRETID"; //"云 API 密钥 SecretId";
        $secretKey = "COS_SECRETKEY"; //"云 API 密钥 SecretKey";
        $region = "COS_REGION"; //设置一个默认的存储桶地域
        $this->cosClient = new Qcloud\Cos\Client(
            array(
                'region' => $region,
                'schema' => 'https', //协议头部，默认为http
                'credentials'=> array(
                    'secretId'  => $secretId ,
                    'secretKey' => $secretKey)));
    }

    public function mAbortMultiPartsUpload() {
        $this->init();

        // 初始化分片上传
        $this->initMultiUpload();

        // 终止分片上传任务
        $this->abortMultiUpload();

	    //.cssg-methods-pragma
    }
}
?>