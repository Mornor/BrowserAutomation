<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;

class RandomTest extends PHPUnit_Framework_TestCase{

	protected $webDriver;
	protected $url = 'https://url.test'; 

	public function setUp(){
		$host = 'http://localhost:4444/wd/hub'; // this is the default
		$this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::firefox()); 
	}

	/*public function tearDown(){
		$this->webDriver->close(); 
	}*/

	public function testKorbenSearch(){
		// Get the url defined in vars
		$this->webDriver->get($this->url);

		// Find the search tab and select it 
		$search = $this->webDriver->findElement(WebDriverBy::id('s')); 
		$search->click(); 

		// Enter some value in it
		$this->webDriver->getKeyboard()->sendKeys('black hat'); 
		$this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER); 

		// Accet the SSL certificate
		$this->webDriver->switchTo()->alert()->accept(); 
	}

}