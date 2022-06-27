<?php

namespace Jp\SindicatoTrainees\infra;

use PDO;

class DBConnector
{
    public static function createConnection(): PDO
    {
        $con = new PDO('mysql:host=db;dbname=sindicato_trainees','root','password');

        //lançar exceção quando houver erro no sql
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //modo padrão do fetch all
        $con->setAttribute(/*attribute:*/PDO::ATTR_DEFAULT_FETCH_MODE, /*value:*/PDO::FETCH_ASSOC);
        return $con;
    }
}