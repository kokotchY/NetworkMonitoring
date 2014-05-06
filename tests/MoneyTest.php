<?php

require '../src/Money.php';

class MoneyTest extends PHPUnit_Framework_TestCase
{
	public function testCanBeNegated()
	{
		$a = new Money(1);
		$b = $a->negate();
		$this->assertEquals(-1, $b->getAmount());
	}
}

?>
