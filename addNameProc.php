<?php

class addNamesProc
{

    function addClearNames()
    {
        $output = "";
        if(isset( $_POST["newName"]) )
        {
            //if(isset($_POST["nameList"]) ) //checks to see if there are other any names already
            if(!empty($_POST["nameList"]))
            {
                $newEntry = $_POST["name"].'\n';
                $fixedNewEntry = fixName($newEntry); //reformats the new name entry
                $nameListString= $fixedNewEntry.$_POST["nameList"]; //puts the new name on top of the name list string
                $output = divy($nameListString); //sorts and returns the namelist string
            }
            else //if there are no other names entered, this is the only name to consider
            {
                $inPut = $_POST["name"].'\n';
                $output = fixName($inPut);//reformats the name
            }

        }
        else if(isset($_POST["clear"]) )//if the clear button was hit, we return an empty string
        {
            $output = "";
        }
        return $output;
    }
}

function fixName($string)
{ //takes a name like"James Dean\n" and returns it like "Dean, James\n"
    
    $len = strlen($string);//this bit lops the '\n' off of the end of the name
    $len = $len - 2;
    $string = substr($string, 0, $len);

    $len--; //sets $len to the index of the last character

    $newName;
    $fName;
    $lName;
    $letter;

    for($i = 0; $i < $len; $i++)
    {
        $letter = $string[$i];
        if($letter === " ")
        {
            $fName = substr($string, 0, $i);
            $lName = substr($string, $i, $len);
        }
    }

    $newName = $lName.", ".$fName.'\n';
    return $newName;
}

function divy($aString)
{    //divides a long string of names into an array, alphebatizes the array, and concatonates the elements of the array back into a string
    $nameArr = [];
    $index = 0;
    $begin = 0;
    $aName = null;
    $length = strlen($aString) - 1;
    $finalOutPut = "";

    for($i = 0; $i < $length; $i++)
    {
        if(substr($aString, $i, 2) === '\n')
        {
            $aName = substr($aString, $begin, $i-$begin);
            $begin = $i + 2;
            $nameArr[$index] = $aName;
            $index++;
        } 
    }

    sort($nameArr);

    foreach($nameArr as $item)
    {
        $finalOutPut .= $item."\n";
    }
    
    return $finalOutPut;

}

   






?>