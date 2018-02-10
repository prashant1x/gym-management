<?php
class DBEngine
{
    private static $db_name = DB_NAME ;
    private static $db_host = DB_HOST ;
    private static $db_user_name = DB_UNAME;
    private static $db_user_password = DB_PWD;
     
    private static $con  = null;
     
    public function __construct() {
        die('cannot instantiate');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$con )
       {     
        try
        {
          self::$con =  new PDO( "mysql:host=" . self::$db_host . ";dbname=" . self::$db_name, self::$db_user_name, self::$db_user_password); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$con;
    }
     
    public static function disconnect()
    {
        self::$con = null;
    }
}
?>