<?php

/**
 *
 */
class Session
{

  public static function init()
  {
    session_start();
  }

  public static function destroy($key = false)
  {
    if ($key ) {
      if (is_array($key) ) {

            for ($i=0; $i < count($key); $i++) {
              if (isset($_SESSION[$key[$i]]) ) {
                unset($_SESSION[$key[$i]]);
              }
            }

      }else {

          if ($_SESSION[$key]) {
              unset($_SESSION[$key]);
          }
      }
    } else {
      session_destroy();
    }



  }
  public static function delete($key = false){

    if ($key):

      if (is_array($key)) {
        echo "es un array";
      }else {
        echo "no es un array";
      }
      echo $_SESSION[$key];
    else:
      echo "no existe la sesion";
    endif;


	}
  public static function get($key){
		if(isset($_SESSION[$key]) ){
			return $_SESSION[$key];
		}
	}



  public static function set($key,$value){
		if (!empty($key)) {
		  $_SESSION[$key]=$value;
		}
	}

  public static function exists($key){
		if(isset($_SESSION[$key])){
			return true;
		}
		return false;
	}

  public static function acceso($level)
  {
    if (!Session::get('autenticado')) {
      Core::header(BASE_URL.'error/index/5050');
      exit;
    }
    if (Session::getLevel($level) > Session::getLevel(Session::get('level')) ) {
      echo Session::get('level');

      exit;
    }else {
      echo Session::get('level');
    }
  }

  public static function accesoView($level)
  {
    if (!Session::get('autenticado')) {
      return false;
    }
    if (Session::getLevel($level) > Session::getLevel(Session::get('level')) ) {
      return false;
    }
    return true;
  }



  public static function getLevel($level)
  {
    $role = array('admin' => 3, 'especial' => 2,'usuario' => 1);


      if (!array_key_exists($level,$role)) {
        throw new Exception("error de acceso", 1);

      }else {
      return $role [$level];
      }
  }

  public static function tiempo()
{


    if(!Session::get('tiempo') || !difined('SESSION_TIME')){
        throw new Exception('No se ha definido el tiempo de sesion');
    }

    if(SESSION_TIME == 0){
        return;
    }

    if(time() - Session::get('tiempo') > (SESSION_TIME * 60)){
        Session::destroy();
          //Core::header(BASE_URL.'error/index/8080');
          echo '<script>alert("tu sesion ha finalizado")</script>';

        exit;
    }
    else{
        Session::set('tiempo', time());
    }
}
}
