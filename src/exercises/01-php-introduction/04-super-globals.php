<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Globals Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/04-super-globals.php">View Example &rarr;</a>
    </div>

    <h1>Super Globals Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Server Information</h2>
    <p>
        <strong>Task:</strong> 
        Display the following information from $_SERVER: PHP_SELF, 
        REQUEST_METHOD, HTTP_HOST, and HTTP_USER_AGENT. Format them 
        nicely with labels.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $server = [
            "PHP_SELF" => "/examples/01-php-introduction/04-super-globals.php",
            "REQUEST_METHOD" => "GET",
            "HTTP_HOST" => "localhost:8080",
            "HTTP_USER_AGENT" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36"
        ];

        foreach ($server as $item => $content) {    
        echo "<ul>";
        echo "<li><strong>$item:</strong> $content</li>";
        echo "</ul>";   
        }
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: URL Parameters</h2>
    <p>
        <strong>Task:</strong> 
        Check if a 'name' parameter exists in the URL. If it does, 
        display "Hello, [name]!". If not, display "Hello, Guest!". 
        Try adding ?name=YourName to the URL for this page.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        if (isset($_GET['name'])) {
        echo "Hello " . $_GET['name'] . "!";
        } 
        else {
        echo "Hello Guest!";
        };
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiple URL Parameters</h2>
    <p>
        <strong>Task:</strong> 
        Check for 'product' and 'quantity' parameters in the URL. 
        If both exist, display "You ordered [quantity] [product](s)". 
        If either is missing, display appropriate error messages. 
        Try adding ?product=Widget&quantity=5 to the URL for this page.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        if (isset($_GET['product'])) {
        echo "You ordered ". $_GET['quantity'] ." ". $_GET['product'] . "(s).";
        }
        else {
        echo "Error. Please try again.";
        };
        ?>
    </div>

</body>
</html>
