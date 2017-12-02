<?php
namespace Intcs;
interface View {
	public function Show($control,$archivo);
	public function setVar($vars);
	public function setTpl($file);
}
?>
