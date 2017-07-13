<?php

/**
 * Class SessionManager
 *  Ufuk Bağcı tarafından yazılmıştır. Açık Kaynak Kütüphanesi olarak kullanılabilir geliştirilebilir.
 *
 */

class SessionManager
{
    private $session_id;
    public static $Instance = NULL;
    private $session_name;


    public function __construct()
    {
        $this->session_id = session_id();
    }

    public static function Instance()
    {
        if (!isset(self::$Instance)) {
            self::$Instance = new SessionManager();
        }
        if (!isset($_SESSION)) {
            self::initSession();
        }

        return self::$Instance;
    }

    //Session Hazırlık.

    /**
     * @param $sessionName
     * @param bool $is_array
     *  Session name string ifade olarak gönderilmelidir.
     *  is_array true olur ise , setSession'da data array olarak gider.
     *
     */

    public function CreateSession($sessionName, $is_array = FALSE)
    {
        try {
            if (is_array($sessionName)) {
                throw new Exception("Session name is not Array");
            } else {
                $_SESSION[$sessionName] = '';
            }
            if (isset($is_array)) {
                $_SESSION[$sessionName] = [];
            } else {
                $_SESSION[$sessionName] = '';
            }
        } catch (Exception  $e) {
            print   $e->getMessage();
        }

    } //End of CreateSession

    //İnit Session

    private function initSession()
    {
        session_start();
    }

    //Session Değerlerini set eder.
    public function setSession($session_name, $data)
    {
        try {
            if (isset($_SESSION[$session_name])) {
                return $_SESSION[$session_name] = $data;
            } else {
                 throw  new Exception("Hata : Set Etmeye çalışılan Session Değeri CreateSession() Methodu ile  oluşturulmamıştır.");
            }
        }
        catch(Exception $e){
            print $e->getMessage();
            }




    }


    //Session Getter.
    public function getSession($session_name)
    {
        return $_SESSION[$session_name];
    }

    /**
     * @param $session_name
     *
     */
    public function SessionKiller($session_name)
    {
        try{
            if(isset($this->session_id)){
                if(isset($_SESSION[$session_name])){
                    unset($_SESSION[$session_name]);
                }
                else{
                    throw new Exception("Session is not Destroyed");
                }
            }
        }catch(Exception $Session){
            print $Session->getMessage();
        }
    }

  public function setSessionName($name){

       $this->session_name = $name;
       return session_name($name);

  }
 //Setter İd
    public function setSessionID(){
      $this->session_id = session_id();
     }
 // Getter id
      public function getSessionID(){
      return $this->session_id;
     }
     public function debugger(){

      
             print "-- Session Save Path :" .  session_save_path();
             print "<br />";
             print  "-- Session PHP Version :" . phpversion();



      


     }
} // End Of Class