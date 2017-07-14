<?php

/**
 * Class SessionManager
 *  Ufuk Bağcı tarafından yazılmıştır. Açık Kaynak Kütüphanesi olarak kullanılabilir geliştirilebilir.
 *
 */

class SessionManager
{
    public static $session_id;
    public static $Instance = NULL;
    private $session_name;
    public static $debugger;


    private function __construct()
    {

    }

    public static function Instance($debug)
    {
        if (!isset(self::$Instance)) {
            self::$Instance = new SessionManager();
        }
        if (!isset($_SESSION)) {
            self::initSession();
        }
        self::$session_id = session_id();
        if(isset($debug)){
            self::$debugger = $debug;
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
                self::SessionKiller($sessionName);
                exit();
            } else {
                $_SESSION[$sessionName] = '';
            }
            if (isset($is_array)) {
                $_SESSION[$sessionName] = [];
            } else {
                $_SESSION[$sessionName] = '';
            }
        } catch (Exception  $e) {

             if(self::$debugger){
                 echo "<pre>";
                 print_r($e->getTrace());
                 print "<br>";
                 print $e->getMessage();
                 exit();
             }
             else{
                 print $e->getMessage();
                 exit();
             }
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
                 self::SessionKiller($session_name);
            }
        }
        catch(Exception $e){
            if(self::$debugger){
                echo "<pre>";
                print_r($e->getTrace());
                echo "</pre>";
                print "<br>";
                print $e->getMessage();
                exit();
            }
            else{
                print $e->getMessage();
                exit();
            }


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
                    exit();
                }
            }
        }catch(Exception $Session){
            if(self::$debugger){
                echo "<pre>";
                print_r($Session->getTrace());
                echo "</pre>";
                print $Session->getMessage();
                exit();
            }
            else{
                print $Session->getMessage();
                exit();
            }
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
             print "----Genel Bilgiler";
             print "<br>";
             print "-- Session Save Path :" .  session_save_path();
             print "<br />";
             print  "-- Session PHP Version :" . phpversion();

             if(isset($_SESSION)){
                 echo "<pre>";
                 print_r($_SESSION);
             }

     }
} // End Of Class