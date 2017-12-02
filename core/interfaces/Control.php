<?php
namespace Intcs;

interface Control{
	public function __toString();
	public function Ajax();
	public function Redirect($path=false, $prefix=false);
}
?>
