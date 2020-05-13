<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Connect_DB_Fnc($SHONiR_DB_Host, $SHONiR_DB_Name, $SHONiR_DB_Username, $SHONiR_DB_Password, $SHONiR_DB_Port = null, $SHONiR_DB_Socket = null) {

// Create connection
$SHONiR_DB_Con = new mysqli($SHONiR_DB_Host, $SHONiR_DB_Username, $SHONiR_DB_Password, $SHONiR_DB_Name, $SHONiR_DB_Port, $SHONiR_DB_Socket);

// Check connection
if ($SHONiR_DB_Con->connect_error) {
    die("Connection failed: " . $SHONiR_DB_Con->connect_error);}

$GLOBALS['SHONiR_DB_Con'] = $SHONiR_DB_Con;

return $SHONiR_DB_Con;

}


function SHONiR_Escape_String_Fnc($SHONiR_Data)
{

    if(strlen($SHONiR_Data)>0){

    $SHONiR_Data = mysqli_real_escape_string($GLOBALS['SHONiR_DB_Con'], $SHONiR_Data);

    }

    return $SHONiR_Data;

}


function SHONiR_Query_Fnc($SHONiR_Query)
{

    $SHONiR_DB_Con = $GLOBALS['SHONiR_DB_Con'];
    $return = $SHONiR_DB_Con->query($SHONiR_Query);

    if ($return != TRUE) {

        echo "Error: " . $SHONiR_Query . "<br>" . $SHONiR_DB_Con->error;
    }


    return $return;

}


function SHONiR_Row_Fnc($SHONiR_Result)
{

    $return = $SHONiR_Result->num_rows;


    return $return;

}


function SHONiR_Fetch_Fnc($SHONiR_Result)
{

    $return = $SHONiR_Result->fetch_assoc();


    return $return;

}

function SHONiR_Fetch_All_Fnc($SHONiR_Result)
{

    $return = mysqli_fetch_all($SHONiR_Result);


    return $return;

}


function SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Result)
{

    $return = mysqli_fetch_all($SHONiR_Result, MYSQLI_ASSOC);


    return $return;

}

function SHONiR_Insert_ID_Fnc()
{
    $SHONiR_DB_Con = $GLOBALS['SHONiR_DB_Con'];

    $return = mysqli_insert_id($SHONiR_DB_Con);

    return $return;

}




function SHONiR_Close_DB_Fnc(){

    $SHONiR_DB_Con = $GLOBALS['SHONiR_DB_Con'];

    $SHONiR_DB_Con->close();

}

?>