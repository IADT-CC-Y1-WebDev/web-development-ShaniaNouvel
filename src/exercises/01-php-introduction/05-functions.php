<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/05-functions.php">View Example &rarr;</a>
    </div>

    <h1>Functions Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Temperature Converter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called celsiusToFahrenheit() that takes a Celsius temperature as a parameter and returns the Fahrenheit equivalent. Formula: F = (C × 9/5) + 32. Test it with a few values.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function celsiusToFahrenheit($celsius) {
            $fahrenheit = ($celsius * 9/5) + 32;
            echo "<p>The $celsius degree celsius is equivilent to $fahrenheit fahrenheit</p>";
        }
        celsiusToFahrenheit(5);
        celsiusToFahrenheit(15);
        celsiusToFahrenheit(25);

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Rectangle Area</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called calculateRectangleArea() that takes width
         and height as parameters. It should return the area. If only one 
         parameter is provided, assume it's a square (both dimensions equal).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function calculateRectangleArea($width, $height = null) {
            if ($height === null) {
                $area = $width * $width;
                echo "<p>The area is $area.</p>";
            }
            else {
                $area = $width * $height;    
                echo "<p>The area is $area.</p>";
            }
        }
        calculateRectangleArea(2, 3);
        calculateRectangleArea(10, 7);
        calculateRectangleArea(2);

        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Even or Odd</h2>
    <p>
        <strong>Task:</strong>
        Create a function called checkEvenOdd() that takes a number and returns 
        "Even" if the number is even, or "Odd" if it's odd. Use the modulo 
        operator (%).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function checkEvenOdd($num) {
            $value = $num % 2;
            if ($value === 0) {
                echo "<p>Even</p>";
            } 
            else {
                echo "<p>Odd</p>";
            } 
        }

         checkEvenOdd(2);
         checkEvenOdd(5);

        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Array Statistics</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called getArrayStats() that takes an array of numbers 
        and returns an array with three values: minimum, maximum, and average. 
        Use array destructuring to display the results.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function getArrayStats($num1, $num2, $num3) {
            if ($num1 < $num2) {
                if($num1 < $num3) {
                    echo "<p>The minimum value is $num1</p>";
                }
            } 
            else if ($num2 < $num3) {
                    echo "<p>the minimum is $num3</p>"; 
            }
            else {
                echo "<p>the minimum value is $num</p>";
            }

            if ($num1 > $num2) {
                if($num1 > $num3) {
                    echo "<p>The maximum value is $num1</p>";
                }
            } 
            else if ($num2 > $num3) {
                    echo "<p>the maximum is $num3</p>"; 
            }
            else {
                echo "<p>The maximum value is $num3</p>";
            }

            $average = ($num1 + $num2 + $num3) / 2;
            echo "The average is $average";
        } 

         getArrayStats(1, 2, 3);

        ?>
    </div>

</body>
</html>
