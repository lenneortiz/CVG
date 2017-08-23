<?php
    class Router{

        public static function route(Request $request){

            $controller = $request->getController().'Controller';
            $method     = $request->getMethod();
            $args       = $request->getArgs();
            $controllerFile = ROOT. '/controllers/'.$controller . '.php';
            //echo $controllerFile;
            if(is_readable($controllerFile)){
                //echo "es legible";
                require_once $controllerFile;

                $controller = new $controller;
                $method = (is_callable(array($controller,$method))) ? $method : 'index';

                //echo "<pre>".print_r('papel')."</pre>";
              //  echo "<pre>".print_r($method)."</pre>";
                if(!empty($args)){
                    call_user_func_array(array($controller,$method),$args);
                }else if(!empty($method)){
                  call_user_func(array($controller,$method));
                }else{
                    call_user_func(array($controller));
                }
                return;

            }else{
                //throw new Exception('404 - la vista para el controlador '.$request->getController().' no esta creada<br>');
                //header('Location:index');exit;
                Core::header(BASE_URL.'error/index/404');
            }

        }
    }
