<?php

include_once ("config.php");

$myfile = fopen("app_structure.json", "r") or die("Unable to open file!");
$decodedFile = json_decode(fread($myfile,filesize("app_structure.json")), true);
fclose($myfile);

//echo "Structure<pre>";
//var_dump($decodedFile["classes"]);
//echo "</pre>";

foreach($decodedFile["classes"] AS $key => $folders){

    /**
    * Procurando e criando pastas raiz do projeto]
    * Exemplo /app
    *
    **/    
    
    foreach($folders AS $key => $folder){
        $pathname = $key;
        make_path($pathname);
        
        //Criando as subpastas        
        foreach($folders[$key] AS $key2 => $value){

            if($key2 === "folder"){
                
                foreach($folders[$key][$key2] AS $key3 => $value){
//                    echo "<pre>";
//                    var_dump($key3);
//                    var_dump($value);
//                    echo "</pre>";
                    
                    $pathname .= DS . $key3;
//                    var_dump($pathname);
                    make_path($pathname);
                    $pathname = str_replace( DS . $key3, "", $pathname);
                    
                    //Criando arquivos e funções das pastas
                    foreach($folders[$key][$key2][$key3] AS $key4 => $value){
                        echo "<pre>";
                        var_dump($key4);
                        var_dump($value);
                        echo "</pre>";
                    }
                    
                }
                
            }
            
        }
        
    }
    
    
//    if($key === "folder"){
//        echo "<pre>";
////        var_dump($key);
//        
//        echo "</pre>";
//    }
    
    
//    foreach($class["folder"] AS $key->$folder){
//        echo "$folder<br/>";
//    }
}

?>