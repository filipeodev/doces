<?php

namespace Src\View;

class ToView
{
	private $urlView;

	public function __construct($urlView)
	{
		$this->urlView = __DIR__ . "/" . $urlView;
	}

	public function viewStandard(string $template, array $data = [])
	{
		require $this->urlView . "/" . $template . ".php";
	}
}
?>