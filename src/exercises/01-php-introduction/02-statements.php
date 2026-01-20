<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/02-statements.php">View Example &rarr;</a>
    </div>

    <h1>Statements Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Age Classifier</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for age. Use if/else statements to classify and 
        display the age group: "Child" (0-12), "Teenager" (13-19), "Adult" 
        (20-64), or "Senior" (65+).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $age = rand(0, 65);

        if ($age <= 12) {
            echo "You are in the Child age group";
        }
        else if ($age <= 19) {
            echo "You are in the Teenager age group";
        }
        else if ($age <= 64) {
            echo "You are in the Adult age group";
        } 
        else if ($age >= 65) {
            echo "You are in the Senior age group";
        }
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Day of the Week</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for the day of the week (use a number 1-7). Use 
        a switch statement to display whether it's a "Weekday" or "Weekend", 
        and the day name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $day = rand(1, 7);

        echo "Today is a ";
        switch (true) {
            case($day <= 1);
                echo "weekday, Monday";
                break;
            case($day <= 2);
                echo "weekday, Tuesday";
                break;
            case($day <= 3);
                echo "weekday, Wednesday";
                break;
            case($day <= 4);
                echo "weekday, Thursday";
                break;
            case($day <= 5);
                echo "weekday, Friday";
                break;
            case($day <= 6);
                echo "weekend, Saturday";
                break;
            case($day >= 7);
                echo "weekend, Sunday";
                break;
            default:
                echo "Error Input";
                break;
        }

        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiplication Table</h2>
    <p>
        <strong>Task:</strong> 
        Use a for loop to create a multiplication table for a number of your 
        choice (1 through 10). Display each line in the format "X × Y = Z".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $num = rand(1, 10);
        echo "The multiples of: $num" . "<br>";
        for ($i = 1; $i < 11; $i++) {
            $sum = $num * $i;
            echo "$num x $i = $sum" . "<br>";
        }
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Countdown Timer</h2>
    <p>
        <strong>Task:</strong> 
        Create a countdown from 10 to 0 using a while loop. Display each number, 
        and when you reach 0, display "Blast off!"
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $num = 10;
        echo "In..." . "<br>";
        for ($i = 0; $i < 10; $i++) {
            $countdown = $num - $i;
            echo "$countdown" . "<br>";
            if ($countdown <=1) {
                echo "Blast Off!!" . "<br>";
            }
        }

        ?>
    </div>

</body>
</html>
