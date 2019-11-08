<?php
namespace Wmc1125\Mctoolsdk;  
use Wmc1125\Mctoolsdk\System;

class Mctool
{
    public function __construct(){
      //使用记录
// include './function.php';
        include './vendor/wmc1125/mctoolsdk/src/tool/System.php';
        dd(\Wmc1125\Mctoolsdk\System::get_info());
    
    }
    public function index(){
        
        return "mctool";
    }
     



}


