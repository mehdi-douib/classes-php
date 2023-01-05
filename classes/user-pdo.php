<?php

class user{
    private $id ;
    public $login ;
    public $password;
    public $email ;
    public $firstname ;
    public $lastname ;

public function register($login, $password, $email, $firstname, $lastname){
    
    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requetelogin= $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requetelogin->execute(array($login));
    $loginexist= $requetelogin->rowCount();

    if($loginexist == 0) {
        $insert= $bdd->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES(?, ?, ?, ?, ?)");
        $insert->execute(array($login, $password, $email, $firstname, $lastname));
        return [$login, $password, $email, $firstname, $lastname];
    }

} 

public function connect($login, $password){
   
    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
    $requser->execute(array($login, $password));
    $userexist = $requser->rowCount();

    if($userexist == 1){
            
        $user= $requser->fetch();

              $this->id = $user['id'];
              $this->login = $user['login'];
              $this->password = $user['password'];
              $this->email = $user['email'];
              $this->firstname = $user['firstname'];
              $this->lastname = $user['lastname'];
              return true;
            }
            
            else
            {   
                  return false;
            }
    }

public function disconnect(){
  
    if (isset($this->id)) { 
    
        $this->id = NULL;
        $this->login = NULL;
        $this->password = NULL;
        $this->email = NULL;
        $this->firstname = NULL;
        $this->lastname = NULL; 
    
    }
    
    return true;
    
    }
    
public function delete(){

    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requser = $bdd->prepare ("DELETE FROM utilisateurs WHERE id = $this->id");
    $requser->execute();
    
return $requser;
    }
    
    
public function update($login, $password, $email, $firstname, $lastname){

    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');   
    $insert = $bdd->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ?  WHERE id = $this->id");
    $insert->execute(array($login, $password, $email, $firstname, $lastname));
    
return true;
    
    }
    
public function isConnected(){
    if (isset($this->id)){
        return 1;
    }
        
    else{
        return 0;
    }
        
}
       
public function getAllInfos(){
    return $this;
    }
               
public function getLogin(){
    return $this->login;
    }
              
public function getEmail(){
    return $this->email;
    }
              
public function getFirstname(){
    return $this->firstname;
    }
        
public function getLastname(){
    return $this->lastname;
    }
        
public function refresh(){
    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requser = $bdd->prepare ("SELECT * FROM utilisateurs WHERE id = $this->id");
    $requser->execute();
    
    
    if(isset($this->id)){
            
        $user= $requser->fetch();
    
        $this->id = $user['id'];
        $this->login = $user['login'];
        $this->password = $user['password'];
        $this->email = $user['email'];
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        return true;
        }
             
    }               
    
}

$mehdi = new user('mehdi', 'tobob', 'mehdi@gmail.com', 'mehdi', 'douib');
$mehdi->register('mehdi', 'tobob', 'mehdi@gmail.com', 'mehdi', 'douib');

var_dump($mehdi->connect('mehdi', 'tobob'));

//var_dump($mehdi->disconnect());

//var_dump($mehdi->delete());

var_dump($mehdi->update('mehdi', 'tobob', 'mehdi@gmail.com', 'mehdi', 'douiba'));

var_dump($mehdi->isConnected());

var_dump($mehdi->getAllInfos());

var_dump($mehdi->getLogin());

var_dump($mehdi->getEmail());

var_dump($mehdi->getFirstname());

var_dump($mehdi->getLastname());

var_dump($mehdi->refresh());

var_dump($mehdi);
?>