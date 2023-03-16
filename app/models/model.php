<?php

use Josantonius\Database\Database;
    
    class Model{
    public static $table ;
    public static function all(){
        return DatabaseConnection::getInstance()
            ->select()
            ->from( self::$table)
            ->execute('obj');
    }

    public static function find($id){
        return DatabaseConnection::getInstance()
            ->select()
            ->from( self::$table)
            ->where(["id = $id"])
            ->execute('obj');
    }

    public static function create($data){
        return DatabaseConnection::getInstance()
            ->insert($data)
            ->in( self::$table)
            ->execute();
    }

    public static function delete($clauses){
        
        return DatabaseConnection::getInstance()
        ->delete()
        ->from(self::$table)
        ->where($clauses)
        ->execute();
    }
}
?>