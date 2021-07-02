<?php

/**
 * Singleton Class
 */
class BTP_SINGLETON {

	private static $instance = null;

	public static function getInstance(){

		if( self::$instance == null ){
			self::$instance = array();
		}

		$class = get_called_class();

		if( !isset( self::$instance[ $class ] ) ){
            self::$instance[ $class ] = new static();
        }

        return self::$instance[ $class ];
	}

}