<?php

interface Subject {
	function registerObserver($id);
	function removeObserver($id);
	function notifyFriends($id);
	function notifyPublic($id);
		
}
