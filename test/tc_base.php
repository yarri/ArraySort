<?php
class TcBase extends TcSuperBase {

	function assertArrayEquals($expected,$ar,$message = null){
		$this->assertEquals($expected,$ar,$message);
		$this->assertEquals(array_keys($expected),array_keys($ar),trim($message." (KEYS)"));
		$this->assertEquals(array_values($expected),array_values($ar),trim($message." (VALUES)"));
	}
}
