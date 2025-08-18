<?php
class DB {
    public static function connect() {
        return new PDO("mysql:host=localhost;dbname=duanmau2;charset=utf8", "root", "");
    }
}
