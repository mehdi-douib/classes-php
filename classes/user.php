<?php

class user{
    private $id ;
    public $login ;
    public $password;
    public $email ;
    public $firstname ;
    public $lastname ;

public function register($login, $password, $email, $firstname, $lastname){
    

    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $insertquery="SELECT * FROM utilisateurs WHERE login = '".$login."'";
    $query = mysqli_query($bdd, $insertquery); 
    $row =  mysqli_num_rows($query);

    if($row == 0) {
        $insertquery= "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES('" .$login. "', '" .$password. "', '" .$email. "', '" .$firstname. "', '" .$lastname. "')";
        $query =  mysqli_query($bdd, $insertquery); 
        return [$login, $password, $email, $firstname, $lastname];
    }

} 

public function connect($login, $password){
   
    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $requete="SELECT * FROM utilisateurs WHERE login = '".$login."' AND password= '".$password."'";
    $query = mysqli_query($bdd, $requete);
    $row =  mysqli_num_rows($query);

        if($row){
            
              $user = mysqli_fetch_assoc($query);

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

    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $requete="DELETE FROM `utilisateurs` WHERE `id` = '".$this->id."'";
    $query = mysqli_query($bdd, $requete);

    return $query;
}

public function update($login, $password, $email, $firstname, $lastname){

    $bdd = mysqli_connect("localhost", "root", "", "classes");    
    $requete = "UPDATE utilisateurs SET login = '".$login."', password = '".$password."', email = '".$email."', firstname = '".$firstname."', lastname = '".$lastname."' WHERE id ='".$this->id."' ";
    $query = mysqli_query($bdd, $requete);

    return $query;

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
    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $requete="SELECT * FROM utilisateurs WHERE id = '".$this->id."' ";
    $result = mysqli_query($bdd, $requete);

    if(isset($this->id)){
        
        $user = mysqli_fetch_assoc($result);

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

var_dump($mehdi->update('mehdi', 'tobob', 'mehdi@gmail.com', 'mehdi', 'douib'));

var_dump($mehdi->isConnected());

var_dump($mehdi->getAllInfos());

var_dump($mehdi->getLogin());

var_dump($mehdi->getEmail());

var_dump($mehdi->getFirstname());

var_dump($mehdi->getLastname());

var_dump($mehdi->refresh());

var_dump($mehdi);
?>