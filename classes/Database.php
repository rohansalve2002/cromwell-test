<?php

class Database
{
    public function connect()
    {
        return new PDO(
            "pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,
            DB_USER,
            DB_PASS
        );
    }
}