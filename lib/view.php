<?php
//@ Author : Usama Noman
class View{

	function __construct($param) {
        $this->view = 'application/views/'.$param;
    }

	function make($param=array())
	{
		require $this->view;
	}

}