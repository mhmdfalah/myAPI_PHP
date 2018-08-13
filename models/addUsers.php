<?php 
  class addUsers {
    // DB stuff
    private $conn;
    private $table = 'users';

    // user Properties
  
    public $name;
    public $email;
    public $age;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Create user
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, age = :age, email = :email';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->email = htmlspecialchars(strip_tags($this->email));
         

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':email', $this->email);
         

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

}
