<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 1/4/2018
 * Time: 11:07 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'../../env-vars.php');

if($_SERVER['HTTP_HOST']=='api.cloudflare.test'){
    $mysqli=new mysqli(DB_SERVER_LOCAL,DB_USERNAME,DB_PASSWORD,DB_NAME);
} else {
    $mysqli=new mysqli(DB_SERVER_FATCOW,DB_USERNAME,DB_PASSWORD,DB_NAME);
}


//balniketansangh.fatcowmysql.com
