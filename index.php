<?php
// Database class to handle database connections and operations
class Database
{
    // Database connection parameters
    private $db_host = 'localhost'; // Hostname of the database server
    private $db_user = 'root';       // Database username
    private $db_pass = '';           // Database password
    private $db_name = 'blog_db';    // Database name
    public $conn;                    // Variable to hold the database connection

    // Method to connect to the database
    public function connect()
    {
        $this->conn = null; // Initialize connection variable
        try {
            // Create a new PDO instance for database connection
            $this->conn = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_pass);
            // Set the PDO error mode to exception for error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Handle connection error
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn; // Return the connection object
    }

    
    /*
    public function executeQuery($query, $params = [])
    {
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        $stmt->execute($params); // Execute the statement with parameters
        return $stmt; // Return the statement object
    }

    public function fetchResults($stmt)
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }
    */
}

// Post class to handle blog post operations
class Post
{
    //post class parameters
    private $conn; // Database connection
    private $table_name = 'posts'; // Table name for posts
    public $id; 
    public $title; 
    public $content; 
    public $author; 
    public $created_at; 
    public $updated_at; 

    // Constructor to initialize the Post object with a database connection
    public function __construct($db)
    {
        $this->conn = $db; // Assign the database connection to the class property
    }

    // Method to create a new post
    public function create()
    {
        // SQL query to insert a new post
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, content=:content, author=:author";
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        // Bind parameters to the SQL query
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->author);
        return $stmt->execute(); // Execute the statement and return the result
    }

    /**
     * Method to update a specific post
     * @param mixed $id - ID of the post to update
     * @return mixed - Result of the execution
     */
    public function update($id)
    {
        // SQL query to update an existing post
        $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content, author = :author, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        // Bind parameters to the SQL query
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Execute the statement and return the result
    }

    /**
     * Method to view a specific post
     * @param mixed $id - ID of the post to view
     * @return mixed - Post data as an associative array
     */
    public function read($id)
    {
        // SQL query to select a specific post
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        $stmt->bindParam(':id', $id); // Bind the post ID parameter
        $stmt->execute(); // Execute the statement
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the post data as an associative array
    }

    /**
     * Method to delete a specific post
     * @param mixed $id - ID of the post to delete
     * @return mixed - Result of the execution
     */
    public function delete($id)
    {
        // SQL query to delete a specific post
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        $stmt->bindParam(':id', $id); // Bind the post ID parameter
        return $stmt->execute(); // Execute the statement and return the result
    }

    /**
     * Method to view all posts
     * @return mixed - Array of all posts
     */
    public function listAll()
    {
        // SQL query to select all posts ordered by creation date
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query); // Prepare the SQL statement
        $stmt->execute(); // Execute the statement
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all posts as an associative array
    }
}

// Create a new Database object and connect to the database
$database = new Database();
$db = $database->connect();

