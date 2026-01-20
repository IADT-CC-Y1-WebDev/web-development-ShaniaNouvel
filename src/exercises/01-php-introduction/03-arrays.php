<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $movies = ['Tangled', 'Beauty and the Beast', 'Zootopia 2', 'Little Women', 'Elementals'];
        echo "<ul>";
        for ($i = 0; $i < count($movies); $i++) {
            $movieNum = $i + 1;
            echo "<li>Movie $movieNum: $movies[$i]</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $student = [
            "name" => "Shania Nouvel Molina",
            "studentId" => "N00254662",
            "course" => "Creative Computing",
            "grade" => "Perfect :D",
        ];

        $information =
            "My name is {$student['name']}, My student number is {$student['studentId']}." . "<br>" . 
            "I am studying {$student['course']} and my grades are {$student['grade']}.";

        echo $information;
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $location = [
            "Ireland" => "Dublin",
            "United Kingdom" => "London",
            "France" => "Paris",
            "Germany" => "Berlin",
            "Italy" => "Rome"
        ];

        echo "<ul>";
        foreach ($location as $country => $capital) {
            echo "<li>The capital of $country is $capital.";
        }
        echo "</ul>";

        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $menu = [
            'Starters' => [
                "Smoked mackerel on toasted crumpets" => "€5.50",
                "Sprout & herb & caper salad" => "€7.35",
                "Creamy mushroom soup" => "€6.25"
            ],
            'Main Course' => [
                "Miso Mushroom and Leek Pasta" => "€16.50",
                "Braised Pork With Lemon, Olives and Tomatoes" => "€27.35",
                "Meat and Potato Skillet Gratin" => "€19.25"
            ]
        ];

        foreach ($menu as $section => $items) {
            echo "<p>" . ucfirst($section);
            echo "<ul>";
            foreach ($items as $meal => $price) {
                echo "<li>$meal\t($price)</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

</body>
</html>
