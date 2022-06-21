
<?php

class NewException extends Exception
{
    public function __construct($message, $code=NULL)
    {
        parent::__construct($message, $code);
    }
   
    public function __toString()
    {
        return "Code: " . $this->getCode() . "<br />Message: " . htmlentities($this->getMessage());
    }
   
    public function getException()
    {
        print $this; // This will print the return from the above method __toString()
    }
   
    public static function getStaticException($exception)
    {
         $exception->getException(); // $exception is an instance of this class
    }
}

set_exception_handler(array("NewException", "getStaticException"));


?>