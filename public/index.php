<?php

    //file explorer address for the directory
    //ex: C:\Users\ishan\Desktop\flex-framework
    define('INC_ROOT', dirname(__DIR__));

    //current directory of the page
    //ex: public
    define('CUR_DIR',basename(__DIR__));

    //HTTP address for the file
    //'http://flex.dev'
    define('HTTP_ROOT','http://'.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'],'',str_replace('\\', '/', INC_ROOT)."/".CUR_DIR));


    require_once INC_ROOT."/app/Framework/init.php";



