<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


    protected function _result($state = 0, $msg = null, $data = null) {
        $output = array();
        $output['state'] = $state;
        if($data != null){
            $output['data'] = $data;
        }
        if($msg != null){
            $output['msg'] = $msg;
        }
        return $output;
    }

}
