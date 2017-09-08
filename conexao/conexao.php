<?php
/*
$conexao = @mysql_connect('127.0.0.1','root','root');
if (!$conexao) {
    die('Não foi possível Conectar: ' . mysql_error());
}
mysql_select_db('usuarios', $conexao);


$conexao = mysqli_connect('localhost','root','root');
mysqli_select_db($conexao, 'usuario');
*/

class Conexao {

    public static $instance;
	public $banco, $conexao;

    private function __construct() 
	{
        $this->conexao = mysqli_connect('localhost','root','root');
        $this->banco = mysqli_select_db($this->conexao, 'usuario');
    }

    public static function getInstance()
	{
        if (!isset(self::$instance))
		{
            self::$instance = new Conexao();            
        }

        return self::$instance;
    }
	
	public function close_connection()
	{
		mysqli_close($this->conexao);
		self::$instance = null;
	}

}
