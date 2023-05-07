<?php
//include('database.php');

class MySQLConnection {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        
        $this->connect();
    }

    function connect() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        //ตั้งค่าภาษาไทย
        $this->conn->query("SET NAMES UTF8");
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function query($sql) {
        $result = mysqli_query($this->conn, $sql); 

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return $result;
    }


    public function prepare($sql) {
        $result = mysqli_prepare($this->conn, $sql); 
        return $result;
    }

    public function multi_query($sql) {
        $result = mysqli_multi_query($this->conn, $sql); 
        return $result;
    }

    public function insertData($table, $data) {
        $columns = array_keys($data);
        $values = array_map(array($this->conn, 'real_escape_string'), array_values($data));
        $values = "'" . implode("', '", $values) . "'";
        $columns = "`" . implode("`, `", $columns) . "`";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            echo ".";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function dropTable($table_name) {
        $sql = "DROP TABLE IF EXISTS $table_name";
        if ($this->conn->query($sql) === TRUE) {
          echo "Table $table_name dropped successfully";
        } else {
          echo "Error dropping table: " . $this->conn->error;
        }
      }

      public function createTable($table_name, $columns) {
        $sql = "CREATE TABLE $table_name ($columns)";
        if ($this->conn->query($sql) === TRUE) {
          echo "Table $table_name created successfully";
        } else {
          echo "Error creating table: " . $this->conn->error;
        }
      }

      public function createTable2($tables) {
        $sql = "$tables";
        if ($this->conn->query($sql) === TRUE) {
          echo "Table created successfully";
        } else {
          echo "Error creating table: " . $this->conn->error;
        }
      }


      public function updateTableWithJoin($table1, $table2, $joinCondition, $setValues) {
    
       
        $sql = "UPDATE $table1 JOIN $table2 ON $joinCondition SET $setValues";
        if ($this->conn->query($sql) === TRUE) {
          echo "ok";
        } else {
          echo "Error creating table: " . $this->conn->error;
        }
      }

      public function insertFromSelect($table1, $table2, $where, $columns)
    {
        $sql = "INSERT INTO $table1 ($columns) SELECT $columns FROM $table2 WHERE $where";

        if ($this->conn->query($sql) === TRUE) {
            echo "Records inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

      
    
 

    function close() {
        mysqli_close($this->conn);
    }

}

?>