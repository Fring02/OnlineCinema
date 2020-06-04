<?php
class Database{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $conn;
    public function __construct($db_host, $db_user, $db_pass, $db_name){
      $this->users = array();  
      $this->db_host = $db_host;
      $this->db_name = $db_name;
      $this->db_user = $db_user;
      $this->db_pass = $db_pass;
      $this->conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
    }
    public function connect(){
        return mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
    }

    public function getAllUsers(){
        if($this->connect()){
            $res = mysqli_query($this->connect(), "SELECT * FROM users");
            $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
            if(empty($row)) return null;
            else return $row;
        }
        return false;
    }

    public function getUser($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $conn = $this->connect();
        $stmt = mysqli_prepare($conn, $sql) or die("Failed");
        if($stmt){
                mysqli_stmt_bind_param($stmt, 'i', $id);
                if(mysqli_stmt_execute($stmt)){
                   $res = mysqli_stmt_get_result($stmt);
                   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                   if(empty($row)) return null;
                   else{
                       $user = new User($row['name'], $row['surname'], $row['email'], $row['nickname'], $row['password']);
                       $user->setId($row['id']);
                       return $user;
                   }
                }
        } else echo mysqli_error($this->connect());
        return null;
            /*($res = mysqli_query($this->connect(), "SELECT * FROM users WHERE id = '$id'");
            $row = mysqli_fetch_array($res);
            if(empty($row)) return null;
            else{
                $user = new User($row['name'], $row['surname'], $row['email'], $row['nickname'], $row['password']);
                $user->setId($row['id']);
                return $user;
            } */
    }

    public function addUser($user){
        if($this->connect()){
            $name = $user->getName();
            $surname = $user->getSurname();
            $email = $user->getEmail();
            $nick = $user->getNickname();
            $pass = $user->getPass();
            $fc = $user->getFilmsCount();
            $sql = "INSERT INTO users(name, surname, email, nickname, password, filmsCount) VALUES(?, ?, ?, ?, ?, ?);";
            $conn = $this->connect();
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, 'sssssi', $name, $surname, $email, $nick, $pass, $fc);
                if(mysqli_stmt_execute($stmt)){
                    $getId = mysqli_query($this->connect(), "SELECT id FROM users WHERE nickname = '$nick'");
                    $row = mysqli_fetch_array($getId);
                    $user->setId($row['id']);
                    $users[$row['id']] = $user;
                    return true;
                }
                else echo mysqli_error($this->connect());
            }
            else echo mysqli_error($this->connect());
           /* $addUser = mysqli_query($this->connect(), "INSERT INTO users(name, surname, email, nickname, password,
            filmsCount) VALUES('$name', '$surname', '$email', '$nick', '$pass', '$fc');");
            if($addUser){
                $getId = mysqli_query($this->connect(), "SELECT id FROM users WHERE nickname = '$nick'");
                $row = mysqli_fetch_array($getId);
                $user->setId($row['id']);
                $users[$row['id']] = $user;
                return true;
            }
            else return false;*/
        }
        return false;
    }

    public function hasUser($user){
        if($this->connect()){
            $nick = $user->getNickname();
            $conn = $this->connect();
            $sql = "SELECT * FROM users WHERE nickname = ?";
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, 's', $nick);
                if(mysqli_stmt_execute($stmt)){
                    $res = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    if(empty($row)) return false;
                    else return true;
                }
            }
            /*
            $check = mysqli_query($this->connect(), "SELECT id FROM users WHERE nickname = '$nick' ");
            $row = mysqli_fetch_array($check);
            if(!empty($row['id'])) return true;
            else return false;*/
        }
        return false;
    }
    public function login($nickname, $password){
        if($this->connect()){
            $sql = "SELECT * FROM users WHERE nickname = ?";
            $conn = $this->connect();
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, 's', $nickname);
                if(mysqli_stmt_execute($stmt)){
                    $res = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    if(empty($row['password'])) echo "<script>alert('You did not signed up.');</script>";
                    else{
                        if($row['password'] == $password){
                            $id = $row['id'];
                            $_SESSION['id'] = $id;
                            $_SESSION['nickname'] = $nickname;
                            $_SESSION['password'] = $password;
                        // header("Location: main.php?id=$id");
                            //exit();
                            return $id;
                            exit();
                        }
                        else{
                            // echo "<script>alert('Wrong password or nickname. Please, try again.');</script>";
                            return null;
                        }
                    }
                } else echo mysqli_error($this->connect());
            } else echo mysqli_error($this->connect());
            /*$res = mysqli_query($this->connect(), "SELECT * FROM users WHERE nickname = '$nickname'");
            $row = mysqli_fetch_array($res);
            if(empty($row['password'])) echo "<script>alert('You did not signed up.');</script>";
            else{
                if($row['password'] == $password){
                $id = $row['id'];
                $_SESSION['id'] = $id;
                $_SESSION['nickname'] = $nickname;
                $_SESSION['password'] = $password;
               // header("Location: main.php?id=$id");
                //exit();
                return $id;
                exit();
                }
                else{
               // echo "<script>alert('Wrong password or nickname. Please, try again.');</script>";
               return null;
                }
            }
        }*/
        }
        return null;
    }

    public function deleteUser($user){
        if($this->connect()){
            $id = $user->getId();
            $sql = "DELETE * FROM users WHERE id = ?";
            $conn = $this->connect();
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, 'i', $id);
                if(mysqli_stmt_execute($stmt)){
                    return true;
                }
                else echo mysqli_error($this->connect());
            } else echo mysqli_error($this->connect());
           /* $res = mysqli_query($this->connect(), "DELETE * FROM users WHERE id = '$id'");
            if($res) return true;
            else return false;*/
        }
        return false;
    }

    public function updateUser($user, $email, $nick, $pass){
        if($this->connect()){
            $id = $user->getId();
            $sql = "UPDATE users SET email = ?, nickname = ?, password = ? WHERE id = ?";
            $conn = $this->connect();
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, 'sssi', $email, $nick, $pass, $id);
                if(mysqli_stmt_execute($stmt)){
                   return true;
                } else echo mysqli_error($this->connect());
            } else echo mysqli_error($this->connect());
            /*$res = mysqli_query($this->connect(), 
            "UPDATE users SET email = '$email', nickname = '$nick', password = '$pass' WHERE id = '$id'");
            if($res) return true;
            else return false;*/
        }
        return false;
    }
}

class User{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $nickname;
    private $pass;
    private $filmsCount;
    public function __construct($name, $surname, $email, $nickname, $pass){
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->pass = $pass;
        $this->filmsCount = 0;
    }
    public function getId(){ return $this->id; }
    public function getName(){ return $this->name; }
    public function getSurname(){ return $this->surname; }
    public function getEmail(){ return $this->email; }
    public function getNickname(){ return $this->nickname; }
    public function getPass(){ return $this->pass; }
    public function getFilmsCount(){ return $this->filmsCount; }

    public function setId($id){ $this->id=$id; }
    public function setName($name){ $this->name=$name; }
    public function setSurname($surname){ $this->surname=$surname; }
    public function setEmail($email){ $this->email=$email; }
    public function setNickname($nick){ $this->nickname=$nick; }
    public function setPass($pass){ $this->pass=$pass; }
    public function setFilmsCount($filmsCount){ $this->filmsCount=$filmsCount; }
}

class Films{

    public function add($conn, $film){
        $sql = "INSERT INTO films(film_name, genre, country, director, actors, premiere_date, description)
        VALUES(?, ?, ?, ?, ? ,? ,?);";
        $name = $film->getName();
        $genre = $film->getGenre();
        $country = $film->getCountry();
        $director = $film->getDirector();
        $date = $film->getDate();
        $actors = $film->getActors();
        $desc = $film->getDesc();
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'sssssss', $name, $genre, $country, $director, $actors, $date, $desc);
            if(mysqli_stmt_execute($stmt)){
                return true;
            }
        }
        return false;
    }

    public function get($conn, $id){
        $sql = "SELECT * FROM films where film_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                return mysqli_fetch_array($res);
            } else{
            echo mysqli_error($conn);
            return null;
            }
        } else{
            echo mysqli_error($conn);
            return null;
        }
        /*$res = mysqli_query($conn, $sql);
        return mysqli_fetch_array($res);*/
    }
    public function contains($conn, $id){
        $sql = "SELECT * FROM films where film_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                if(empty($row)) return false;
                else return true;
            } else echo mysqli_error($conn);
        } else echo mysqli_error($conn);
        return false;
        /*$res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) == 0) return false;
        else return true;*/
    }
    public function hasFilm($conn, $name){
        $sql = "SELECT * FROM films where film_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 's', $name);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                if(empty($row)) return false;
                else return true;
            } else echo mysqli_error($conn);
        } else echo mysqli_error($conn);
        return false;
        /*$res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) == 0) return false;
        else return true;*/
    }
    public function update($conn, $film){
        $id = $film->getId();
        $genre = $film->getGenre();
        $country = $film->getCountry();
        $director = $film->getDirector();
        $actors = $film->getActors();
        $desc = $film->getDesc();
        $date = $film->getDate();
$sql = "UPDATE films SET genre = ?, country = ?, director = ?, actors = ?,
 description = ?, premiere_date = ? WHERE film_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ssssssi', $genre, $country, $director, $actors, $desc, $date, $id);
            if(mysqli_stmt_execute($stmt)){
                return true;
            }
        }
       return false;
    }
    public function deleteById($conn, $id){
        $sql = "DELETE FROM films WHERE film_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if(mysqli_stmt_execute($stmt)){
                return true;
            }
        }
        //$res = mysqli_query($conn, "DELETE FROM films WHERE film_id = $id");
        return false;
    }
}
class Film{
    private $id; private $name; private $date;
    private $genre; private $country; private $director; private $actors; private $desc;


    public function getId(){return $this->id; }
    public function getName(){return $this->name; }
    public function getGenre(){return $this->genre; }
    public function getCountry(){return $this->country; }
    public function getDirector(){return $this->director; }
    public function getActors(){return $this->actors; }
    public function getDesc(){return $this->desc; }   
    public function getDate(){ return $this->date; }

    public function setId($id){ $this->id = $id; }
    public function setName($name){ $this->name = $name; }
    public function setGenre($genre){ $this->genre = $genre; }
    public function setCountry($country){ $this->country = $country; }
    public function setDirector($director){ $this->director = $director; }
    public function setActors($actors){ $this->actors = $actors; }
    public function setDesc($desc){ $this->desc = $desc; }   
    public function setDate($date){ $this->date = $date;}
}
$db = new Database('localhost', 'Sultanbek', 'Rubin1!!', 'test');
$filmsSet = new Films();
?>