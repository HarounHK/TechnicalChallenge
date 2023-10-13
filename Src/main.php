<?php

//Database details
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "data"; 

//Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Checking connection error
if ($conn->connect_error) 
{
    die("Connection failed: ".$conn->connect_error);
}

//Initializing the search variable
$search = "";

//Checking to see if search is provided
if (isset($_GET['search'])) 
{
    $search = $_GET['search'];
}

//Fetches data from the countries table in database based on search
$sql = "SELECT * FROM countries WHERE name LIKE '%" . $search . "%'";
$result = $conn->query($sql);

//Creating and storing data in an array
$countries = array(); 
if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) 
    {
        $countries[] = $row;
    }
}

//Closes the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Countries</title>
    <style>
        table 
        {
            width: 100%;
            border-collapse: collapse;
        }
        th, td 
        {
            border: 6px solid lightgrey;
            padding: 10px;
            text-align: left;           

        }
        th 
        {
            background-color: #f2f4f4;
        }
    </style>
</head>
<body>
    <h1>World Countries</h1>
    <form action="" method="get">
        <label for="search">Search for a Country:</label>
        <input type="text" id="search" name="search" value="<?php echo $search; ?>">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>

        <!--For each loop to place countries in table and generate rows with each country-->
        <?php 
        foreach ($countries as $country) : 
        ?>
            <tr>
                <td><?php echo $country['id']; ?></td>
                <td><?php echo $country['name']; ?></td>
            </tr>
        <?php 
        endforeach; 
        ?>

    </table>
</body>
</html>
