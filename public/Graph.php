<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport">
        <link rel="icon" type="image/x-icon" href="PixelForge.jpeg">
        <title> Graph page</title>   
        <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #F5F5F5;
            color: #065508;
            }
            header {
                background: #065508;
                color: #F5F5F5;
                padding: 0.5rem 0;
                text-align: center;
                font-size: large;
            }
            nav {
                background: #065508;
                padding: 0.5rem;
                text-align: center;
            }
            nav a {
                display: inline-block;
                background: #F5F5F5;
                color: #065508;
                text-decoration: none;
                padding: 0.5rem 1rem;
                margin: 0 0.5rem;
                border-radius: 25px;
                font-weight: bold;
                transition: background 0.3s ease, color 0.3s ease;
            }
            nav a:hover {
                background: #065508;
                color: #F5F5F5;
            }
            .container {
                max-width: 800px;
                margin: 2rem auto;
                background: #fff;
                padding: 1.5rem;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .input{
                text-align: center;
                padding-top: 50px;
                color: #053305
            }
        </style> 
    </head>
    <body>
    <header>
        <h1>Graphing</h1>
    </header>
    <nav>
        <a href="/index.html">Home</a>
        <a href="About.php">About Us</a>
        
    </nav>

    <div class = "input">
        <?php $rows=0;  ?>
        <p>Enter the number of rows (between 1 and 1000) and columns (between 1 and 702) you would like in your table. </p>
        <form method="GET" action="Graph.php">
            Rows:     <input type="number" id="rows1" name="rows" placeholder="1-1000" min="1" max ="1000" value="<?php echo $rows;?>">
            Columns:  <input type="number" id="columns1" name="columns" placeholder="1-702" min="1" max ="702">
            Colors:   <input type="number" id="colors1" name="colors" placeholder="1-10" min="1" max="10">
            <input type ="submit">
        </form>
        <?php 
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $rows = ($_POST["rows"]);
            
        }
        
        ?>
        <?php echo $rows; ?>


    </div>
    </body>