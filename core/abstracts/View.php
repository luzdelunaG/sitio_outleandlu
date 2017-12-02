<?php
namespace Abs;

abstract class View{
	abstract public function Show($control, $archivo);
	abstract public function setVar($vars);
	abstract public function setTpl($file);
}
?>
