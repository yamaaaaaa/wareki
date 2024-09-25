<?php

namespace yamaaaaaa\Wareki\Tests;

use PHPUnit\Framework\TestCase;
use yamaaaaaa\Wareki\Wareki;

class WarekiTest extends TestCase
{
	
	public function testNew():void{
		$wareki = new Wareki();
		$formated = $wareki->format('ERA');
		var_dump($formated);
		$this->assertIsString($formated);
	}
	
	public function testEra() : void{
		$now = time();
		$wareki = Wareki::make('1800-01-01 00:00:00');
		while($wareki->timestamp < $now){
			$formated = $wareki->format('Y:ERA');
			if($wareki->year < 1868){
				$check = '西暦';
			}else if($wareki->year < 1912){
				$check = '明治';
			}else if($wareki->year < 1926){
				$check = '大正';
			}else if($wareki->year < 1989){
				$check = '昭和';
			}else if($wareki->year < 2019){
				$check = '平成';
			}else{
				$check = '令和';
			}
			$result = preg_match('/'.$check.'/',$formated);
			$this->assertTrue($result==1);
			var_dump($formated.'>>>>check:'.$check);			
			$wareki->addYear();
		}
	}
	
	
}