<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exceptions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/08-exceptions.php">View Example &rarr;</a>
    </div>

    <h1>Exceptions Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Basic Exception Handling</h2>
    <p>
        <strong>Task:</strong>
        Create a function called <code>calculateSquareRoot($number)</code> that throws an
        exception if the number is negative (you cannot take the square root of a negative number).
        If the number is valid, return its square root using <code>sqrt()</code>.
        Test it with values 16, 25, and -9, catching any exceptions.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        function calculateSquareRoot($number) {
            if ($number < 0) {
                throw new Exception("Invalid number");
            }
            return sqrt($number);
        }

        try {
            $total = calculateSquareRoot(16);
            echo "The Square root of 16 is " . $total . "<br>";

            $total = calculateSquareRoot(25);
            echo "The Square root of 25 is " . $total . "<br>";

            $total = calculateSquareRoot(-9);
            echo "Invalid Value" . "<br>";
        }
        catch (Exception $e) {
            echo "Error: " . $e ->getMessage() . "<br>";
        }

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Validating User Input</h2>
    <p>
        <strong>Task:</strong>
        Create a function called <code>validateEmail($email)</code> that checks if an email
        address contains an "@" symbol. If it doesn't, throw an exception with the message
        "Invalid email: missing @ symbol". Test it with "user@example.com", "invalid-email",
        and "test@test.ie".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        
        function validateEmail($email) {
            if (strpos($email, '@') === false) {
                throw new Exception("Invalid email");
            }
            return "$email is validated";
        }

        $emailAddress = [
            "user@example.com",
            "invalid-email",
            "test@test.ie"
        ];

        foreach ($emailAddress as $email) {
            try {
                $result = validateEmail($email);
                echo "$result<br>";
            } 
            catch (Exception $e) {
                echo $e->getMessage() . "<br>";
            }
        }
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Using Finally</h2>
    <p>
        <strong>Task:</strong>
        Create a function called <code>processFile($filename)</code> that throws an exception
        if the filename is empty. Use a try/catch/finally block where the finally block
        always prints "Processing complete". Test with both a valid filename and an empty string.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        function processFile($filename) {
            if ($filename === "") {
                throw new Exception("Invalid filename!");
            }
            return "Processing complete." . "<br>" . "File $filename loaded.";
        }

        try {
            $file = processFile("HOLA.mp4") ;
            echo $file;
        }
        catch (Exception $e) {
            echo $e->getMessage() . "<br>";
        }
        finally {
            echo "<br>Cleanup complete</br>";
        }

        ?>
    </div>

</body>
</html>
