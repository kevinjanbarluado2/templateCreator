<?php
if(defined('admin')){
$config = new stdClass();
$config->base_url = "http://localhost/templateCreator/";
$config->its=array(["id"=>1,"name"=>"Kevin"],["id"=>2,"name"=>"Samuel"],["id"=>3,"name"=>"Omar"]);
} else{
    echo "unable to access";
}
