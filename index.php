<?php
namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

//Establish host, capabilities and web driver
$host = 'http://localhost:4444/';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

//Navigate to page
$driver->get('https://www.argos.co.uk/search/sim-free-smartphones/,');


//Select all names (names have itemProp = "name")
$names = $driver->findElements(WebDriverBy::xpath("//a[@itemProp='name']"));
//Select all prices (prices are <strong> elements within a div containing the data-el attribute)
$prices = $driver->findElements(WebDriverBy::xpath("//div[@data-el]/strong"));
//Initialise output array
$data = array();

//Verify that the names and prices arrays are of the same length
if(count($names)==count($prices)){
  for($i = 0; $i < count($names); $i ++){
    //Create temporary array variable, and push to the end of the data array
    $instance = array("name"=>$names[$i]->getText(),"price"=>$prices[$i]->getText());
    array_push($data, $instance);
  }
  echo("Data formed");
  //The below line will output the data to the console in a readable format if uncommented.
  // echo("<script>console.log(".json_encode($data).")</script>");
}else{
  echo("Error");
}
//Close the driver screen
$driver->quit();

?>
