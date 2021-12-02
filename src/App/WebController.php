<?php
namespace Src\App;

use Src\View\ToView;
use Src\App\Message;

class WebController{

	//metodos de erros
	public function error(){
		try {
			$toView = new ToView(URL_VIEW_WEB);
			$toView->viewStandard("404");
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function home():void{
		try {
			$msg = new Message();
			$data = [$msg->getME(), $msg->getMS()];
			$toView = new ToView(URL_VIEW_WEB);
			$toView->viewStandard("login", $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
}
?>