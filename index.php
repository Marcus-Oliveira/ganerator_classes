<?php

include_once ("config.php");

use Memio\Memio\Config\Build;
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Model\Property;
use Memio\Model\Method;
use Memio\Model\Argument;


function createClass($namespace, $className){
    
    $class = Object::make('User');

    $nameProperty = Property::make('name');
    $class->addProperty($nameProperty);

    $getNameMethod = Method::make('getName')->setBody('return $this->name');
    $class->addMethod($getNameMethod);
    
    $prettyPrinter = Build::prettyPrinter();
    
    // Or display it in a browser
    echo '<pre>'.htmlspecialchars($prettyPrinter->generateCode($class)).'</pre>';

    $myfile = fopen("newfile.php", "w") or die("Unable to open file!");
    $txt = $prettyPrinter->generateCode($class);
    fwrite($myfile, $txt);
    fclose($myfile);
    
}

createClass('App\Services', 'MyService');




function createClassB($namespace, $className){
    
    // Describe the code you want to generate using "Models"
    $file = File::make('src/Vendor/Project/MyService.php')
        ->setStructure(
            Object::make($namespace . '\\' . $className)
                ->addProperty(new Property('createdAt'))
                ->addProperty(new Property('filename'))
                ->addMethod(
                    Method::make('__construct')
                        ->addArgument(new Argument('DateTime', 'createdAt'))
                        ->addArgument(new Argument('string', 'filename'))
                )
        )
    ;

    // Generate the code and display in the console
    $prettyPrinter = Build::prettyPrinter();
    //$generatedCode = $prettyPrinter->generateCode($file);
    //echo $generatedCode;

    // Or display it in a browser
    echo '<pre>'.htmlspecialchars($prettyPrinter->generateCode($file)).'</pre>';

    $myfile = fopen("newfile.php", "w") or die("Unable to open file!");
    $txt = $prettyPrinter->generateCode($file);
    fwrite($myfile, $txt);
    fclose($myfile);
    
}



?>