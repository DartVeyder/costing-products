<?php

use Josantonius\Database\Database;

class Model
{
    public static $table; 
   

    public static function allJoin($select = [], $where = [], $joins = [], $as = [])
    {  
        $query[] = self::colums($select, $as);
        $query[] = "FROM " . self::$table;
        $query[] = self::join($joins); 
        $where = self::where($where);
        $query[] = $where['query'];  
       
        $result  =  DatabaseConnection::getInstance()
            ->query(
                implode(" ", $query),
                $where['statements'],
                'array_assoc' // array_assoc, obj, array_num
            );  
            return self::num($result);
    }

    private static function num($array){
        $n = 1;
         
        foreach ($array as $key => $value) {  
            $array[$key]['num'] = $n++; 
        }

        return $array;
    }

    public static function findJoin($select = [], $where = [], $joins = [], $as = [])
    {  
        $query[] = self::colums($select, $as);
        $query[] = "FROM " . self::$table;
        $query[] = self::join($joins); 
        $where = self::where($where);
        $query[] = $where['query']; 
        return DatabaseConnection::getInstance()
            ->query(
                implode(" ", $query),
                $where['statements'],
                'array_assoc' // array_assoc, obj, array_num
            )[0]; 
    }

    private static function where($array){
        $data = [];
        if($array){
        foreach ($array as $key => $item) {
            $data['query'][] = self::$table.".$key = :$key";
            $data['statements'][] = [":$key" , $item];
        }
        $data['query'] = "WHERE " . implode(" AND ", $data['query']);
    }else{
        $data['statements'] = false;
        $data['query'] = "";
    }
        return  $data;
    } 

    private function as($data)
    {
        $array = [];
        foreach ($data as $key => $item) {
            $array[] = $key . " as " . $item;
        }
        return implode(", ", $array);
    }

    private static function join($data)
    {
        $array = [];
        foreach ($data as $key => $item) {
            $j = [];
            $j[] = $item['table'] . ' ' . $item['table'];
            $j[] = "ON " . self::$table . "." . $item['on']['with'] . ' = ' .  $item['table'] . "." . $item['on']['on'];

            $array[] =  'LEFT JOIN ' . implode(" ", $j);
        }
        return implode(" ", $array);
    }
    private static function colums($select, $as)
    {
        $array = [];
        foreach ($select as $item) {
            $array[] = self::$table . "." . $item;
        }
        $array[] = @self::as($as);
        return 'SELECT ' . implode(', ', $array);
    }

    public static function all($clauses = [])
    {
        if($clauses){
            $result =  DatabaseConnection::getInstance()
            ->select()
            ->from(self::$table)
            ->where($clauses)
            ->execute('array_assoc');
        }else{
            $result =  DatabaseConnection::getInstance()
            ->select()
            ->from(self::$table) 
            ->execute('array_assoc');
        }
        
            return self::num($result); 
    }

    public static function find($clauses, $columns = '*')
    {
        return DatabaseConnection::getInstance()
            ->select($columns)
            ->from(self::$table)
            ->where($clauses)
            ->execute('array_assoc')[0];
    }

    public static function create($data)
    { 
            return DatabaseConnection::getInstance()
            ->insert($data)
            ->in(self::$table)
            ->execute();
       
        
    }

    public static function replace($data)
    {
        return DatabaseConnection::getInstance()
        ->replace($data)
        ->from(self::$table)
        ->execute();
       
    }

    public static function delete($clauses)
    {

        return DatabaseConnection::getInstance()
            ->delete()
            ->from(self::$table)
            ->where($clauses)
            ->execute();
    }

    public static function softDelete($clauses){
        return DatabaseConnection::getInstance()
        ->update(['delete_at' => date('Y-m-d H:i:s')])
        ->in(self::$table)
        ->where($clauses)
        ->execute();
    }
}
