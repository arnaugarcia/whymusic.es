<?php

class Config{
    public $appName = "WhyMusic";
    public $layout = "layouts/layout";
    public $debug = true;
    public $db = array(
        'mysql' => array(
            'driver' => 'mysql',
            'dbname' => 'uqfhhbcn_whymusic',
            'host' => 'localhost:3306',
            'user' => 'uqfhhbcn',
            'password' => 'soserexo',
        ),
        'pgsql' => array(
            'driver' => 'pgsql',
            'dbname' => '',
            'host' => '',
            'port' => 5432,
            'user' => '',
            'password' => '',
        ),
    );
    public $mailer = array(
        'gmail' => array(
            'isSMTP' => true,
            'SMTPAuth' => true,
            'SMTPSecure' => 'ssl',
            'Host' => 'smtp.gmail.com',
            'Port' => 465,
            'Username' => 'user@gmail.com',
            'Password' => 'password',
            'From' => 'user@gmail.com',
            'FromName' => 'Administrator',
        ),
        'hotmail' => array(
            'isSMTP' => true,
            'SMTPAuth' => true,
            'SMTPSecure' => 'tls',
            'Host' => 'smtp.live.com',
            'Port' => 25,
            'Username' => 'user@hotmail.com',
            'Password' => 'password',
            'From' => 'user@hotmail.com',
            'FromName' => 'Administrator',
        ),
    );
    public $DirectoryIndex = "index.php?r=demo/index";
    public $ErrorPage = "index.php?r=demo/error";
    public $rules = array(
        "demo/index" => array(
             "?r=demo/index" => "index",
             "?r=demo/index&id=$1" => "index/id/([0-9]+)",
             "?r=demo/index&id=$1&title=$2" => "index/id/([0-9]+)/title/([a-zA-Z]+)",
        ),
        "demo/login" => array(
            "?r=demo/login" => "login",
        ),
    );
}