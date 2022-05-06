<?php

    $localhost = "localhost";
    $db = "nikeshoes";
    $user = "root";
    $password = "";
    $con = mysqli_connect($localhost,$user,$password,$db);

    function insert($val){
        global $con;
        $result = mysqli_query($con,$val);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function delete($val){
        global $con;
        $result = mysqli_query($con,$val);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function getRow($table,$field,$value){
        global $con;

        $sql = "SELECT * FROM `$table` WHERE `$field` = '$value'";

        $result = mysqli_query($con,$sql);

        if($result){
            $row = [];
            if(mysqli_num_rows($result) > 0){
                $rows[] = mysqli_fetch_assoc($result);
                return $rows[0];
            }
        }
        return false;

    }


    function getRows($table){
        global $con;

        $sql = "SELECT * FROM `$table`";

        $result = mysqli_query($con,$sql);

        if($result){
            $rows = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row; 
                }
            }
        }
        return $rows;

    }

    function getRowsCart($table,$id){
        global $con;

        $sql = "SELECT * FROM `$table` WHERE `user_id` = '$id'";

        $result = mysqli_query($con,$sql);

        if($result){
            $rows = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row; 
                }
            }
        }
        return $rows;

    }


    function getRowsIndex($table){
        global $con;

        $sql = "SELECT * FROM `$table` LIMIT 6";

        $result = mysqli_query($con,$sql);

        if($result){
            $rows = [];
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $rows[] = $row; 
                }
            }
        }
        return $rows;

    }