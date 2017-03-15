<?php
require_once("../db/Database.php");
require_once("../interfaces/IUser.php");
class User implements IUser {
    private $con;
    private $id;

    private $professor;
    private $date;
    private $start;
    private $finish;
    private $topic;
    public function __construct(Database $db){
        $this->con = new $db;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setProfessor($professor){
        $this->professor = $professor;
    }
    public function setDate($date){
        $this->date= $date;
    }
    public function setStart($start){
        $this->start = $start;
    }
    public function setFinish($finish){
        $this->finish = $finish;
    }
    public function setTopic($topic){
        $this->topic = $topic;
    }
    //insertamos usuarios en una tabla con postgreSql
    public function save() {
        try{
            $query = $this->con->prepare('INSERT INTO users (username, password) values (?,?)');
            $query->bindParam(1, $this->username, PDO::PARAM_STR);
            $query->bindParam(2, $this->password, PDO::PARAM_STR);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
    public function update(){
        try{
            $query = $this->con->prepare('UPDATE users SET username = ?, password = ? WHERE id = ?');
            $query->bindParam(1, $this->username, PDO::PARAM_STR);
            $query->bindParam(2, $this->password, PDO::PARAM_STR);
            $query->bindParam(3, $this->id, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    //obtenemos usuarios de una tabla con postgreSql
    public function viewStudent(){
        try{
            if(!empty($this->id)){
                $query = $this->con->prepare('select hours.professor as "Profesor",date,hours.start,hours.finish,topic from availabledates,hours where officehour = hours.id and student = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                $query = $this->con->prepare('SELECT * FROM student');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    public function get(){
        try{
            if(is_int($this->id)){
                $query = $this->con->prepare('SELECT id FROM student');
                //$query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
                return $query->fetch(PDO::FETCH_OBJ);
            }
            else{
                $query = $this->con->prepare('SELECT * FROM student');
                $query->execute();
                $this->con->close();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    public function delete(){
        try{
            $query = $this->con->prepare('DELETE FROM users WHERE id = ?');
            $query->bindParam(1, $this->id, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
            return true;
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    public static function baseurl() {
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/consultinghours/";
    }
    public function checkUser($user) {
        if( ! $user ) {
            header("Location:" . User::baseurl() . "app/list.php");
        }
    }
}


?>