<?php


    function checkempty($val){
        if(empty($val)){
            return false;
        }else{
            return true;
        }
    }

    function checkless($val,$len){
        if(trim(strlen($val) <= $len)){
            return false;
        }else{
            return true;
        }
    }

    function validemail($email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        return true;
    }


    