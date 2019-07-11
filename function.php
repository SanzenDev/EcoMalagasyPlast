    <?php

    function toMajuscule($str){
        return strtoupper($str);
    }

    echo toMajuscule('pomme').'<br />';
    echo toMajuscule('homme').'<br />';
    echo toMajuscule('dell').'<br />';
    echo toMajuscule('pc').'<br />';



    function countArray($arr){
        return count($arr);
    }

    echo countArray(array('a', 'b')).'<br />';
    echo countArray(array('a')).'<br />';
    echo countArray(array('a', 'b','a', 'b', 'a', 'b', 'a', 'b')).'<br />';
    echo countArray(array()).'<br />';

    function toMajuscule($str){
        return strtoupper($str).'<br />';
    }

    echo toMajuscule('pomme');
    echo toMajuscule('homme');
    echo toMajuscule('cool');


//--------------------------------//
   function transformMajuscule($arr){
        $arrMaj = [];
        foreach ($arr as $key => $value) {
            $arrMaj[] = strtoupper($value);
        }
        return implode('-', $arrMaj).'<br />';
    }

     echo transformMajuscule(array('banane', 'pomme'));
     echo transformMajuscule(array('gasy', 3));


 // --------------------------
    function transformMajuscule($arr){
        $arrMaj = [];
        foreach ($arr as $key => $value) {
            $arrMaj[] = is_string($value) ? strtoupper($value) : $value+1;
        }
        return implode('-', $arrMaj).'<br />';
    }

     echo transformMajuscule(array('banane', 'pomme'));
     echo transformMajuscule(array('gasy', 3));

