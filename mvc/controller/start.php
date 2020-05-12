<?php
class Start extends Controller{
	
	function init(){
		//initialize
		$this->params['onPage'] = ($this->params['onPage'])?$this->params['onPage']:$GLOBALS['onPage'];
		$this->params['page'] = ($this->params['page'])?$this->params['page']:1;
		$this->renderResult['renderVariables']['page'] = $this->params['page'];
		$this->renderResult['renderVariables']['onPage'] = $this->params['onPage'];
		$this->renderResult['tasks'] = $this->model->getTasks($this->params);
		$this->renderResult['renderVariables']['total'] = $this->model->getLastSQLTotal();
		$this->renderResult['renderVariables']['direct'] = $this->model->hrefDirect($this->params);
		//print_r($this->params);
	}
	
	function itemsTest(){
		//echo "itemsTest<br/>\n";
		
		//$this->test('qwer');
	}
	
}