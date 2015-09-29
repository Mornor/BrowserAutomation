<?php

use Facebook\WebDriver\Remote\DesiredCapabilities; 
use Facebook\WebDriver\Remote\RemoteWebDriver; 
use Facebook\WebDriver\WebDriverBy; 
use Facebook\WebDriver\WebDriverKeys; 

class LocalhostTest extends PHPUnit_Framework_TestCase{


	protected $webDriver; 

	public function setUp(){
		$this->webDriver = RemoteWebDriver::create('http://127.0.0.1:4444/wd/hub', DesiredCapabilities::firefox()); 
		$this->webDriver->get('http://127.0.0.1/simpleForm'); 
	}

	public function testFormExists(){
		$this->assertEquals(true, count($this->webDriver->findElements(WebDriverBy::name('username'))) > 0);  
		$this->assertEquals(true, count($this->webDriver->findElements(WebDriverBy::name('password'))) > 0); 
		$this->assertEquals(true, count($this->webDriver->findElements(WebDriverBy::name('address'))) > 0); 
		$this->assertEquals(true, count($this->webDriver->findElements(WebDriverBy::name('creditCard'))) > 0); 
		$this->assertEquals(true, count($this->webDriver->findElements(WebDriverBy::name('telNumber'))) > 0);  
	}

	/** @dataProvider validInputsProvider */
	public function testValidInputs(array $inputs){
		$this->fillAndSubmitForm($inputs); 
	}

	public function fillAndSubmitForm(array $inputs){		
		// Fill the form
		foreach ($inputs as $input => $value) {
			$this->webDriver->findElement(WebDriverBy::name($input))->sendKeys($value);
		}

		// Test if the value are correct
		$this->assertTrue(is_numeric($this->webDriver->findElement(WebDriverBy::name('creditCard'))->getAttribute('value')) ); 

		$this->webDriver->findElement(WebDriverBy::cssSelector('body > form:nth-child(1) > input:nth-child(21)'))->click(); 

	}

	public function validInputsProvider(){
		$inputs[] = [
			[
				'username' => 'Celien',
				'password' => 'password', 
				'address' 	=> 'La cote', 
				'creditCard' => '45698847', 
				'telNumber' => '4556'
			]
		]; 

		return $inputs; 
	}

	/*public function tearDown(){
		$this->webDriver->quit();
	}*/
}