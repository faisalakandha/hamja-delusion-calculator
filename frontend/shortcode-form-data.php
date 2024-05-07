<?php

function handle_delusion_calculator_form()
{
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $gender = isset($_POST['men']) ? 'Male' : 'Female';
        $ageRangeMin = $_POST['ageMin'];
        $ageRangeMax = $_POST['ageMax'];
        $minIncome = $_POST['minIncome'];
        $maxIncome = $_POST['maxIncome'];
        $ethnicity = $_POST['ethnicity'];
        $excludeObese = isset($_POST['obese']) ? 'Yes' : 'No';
        $excludeMarried = isset($_POST['married']) ? 'Yes' : 'No';
        $minHeight = $_POST['heightMin'];
        $maxHeight = $_POST['heightMax'];

        $Height = "<p>Height Range: " . floor($minHeight / 12) . "'" . ($minHeight % 12) . " - " . floor($maxHeight / 12) . "'" . ($maxHeight % 12) . "</p>";



        // Display the submitted values
        // echo "<h2>Form Submitted Successfully</h2>";
        // echo "<p>Gender: $gender</p>";
        // echo "<p>Age Range: $ageRangeMin - $ageRangeMax</p>";
        // echo "<p>Minimum Income: $$minIncome K - Maximum Income: $$maxIncome K</p>";
        // echo "<p>Ethnicity: $ethnicity</p>";
        // echo "<p>Exclude Obese: $excludeObese</p>";
        // echo "<p>Exclude Married: $excludeMarried</p>";
        // echo "<p>Height Range:" . $Height . "</p>";

        $test_data = [
            'age_range' => [$ageRangeMin, $ageRangeMax],  // Age range between 25 and 35
            'income_slider' => $minIncome * 1000,   // Minimum income of $75,000
            'race' => ucfirst($ethnicity),  // Selected races: White and Asian
            'height_feet' => floor($minHeight / 12),
            'height_inches' => ($minHeight % 12),
            'gender_preference' => $gender, // Optional: Male partner preference
            'exclude_obese' => $excludeObese,    // Optional: Exclude obese individuals
        ];

        $results = calculate_dating_pool($test_data);
        $american_population = $gender == 'Male' ? array('gender' => 'men', 'population' => 164977341) : array('gender' => 'women', 'population' => 168310216);

        $percentage = $results["percentage"] / 100; // Convert percentage to decimal

        $matched_population = round($american_population['population'] * $percentage);
        function printImages($percentage) {
            // Define the thresholds and corresponding counts
            $thresholds = [100, 80, 60, 40, 20,0];
            $counts = [0, 1, 2, 3, 4, 5];
        
            // Find the appropriate count based on the percentage
            $imageCount = 0;
            foreach ($thresholds as $index => $threshold) {
                if ($percentage >= $threshold) {
                    $imageCount = $counts[$index];
                    break;
                }
            }
        
            echo "<p class='text-4xl py-3'>$imageCount/5</p>";


            echo '<div class="flex p-2 items-center justify-center py-5">';

            // Print the x images
            for ($i = 0; $i < $imageCount; $i++) {
                echo "<img width='100px' src='https://igotstandardsbro.com/img/score_item_on.df14762f.svg' alt='x image'>";
            }
        
            // Print the y images (if any vacancy)
            $vacancy = max(5 - $imageCount, 0);
            for ($i = 0; $i < $vacancy; $i++) {
                echo "<img width='100px' src='https://igotstandardsbro.com/img/score_item_off.801320a1.svg' alt='y image'>";
            }

            // Print the count
            echo '</div>';

            echo '<div style="color:lightblue;" class="text-2xl py-4">' . printImageText($imageCount) . '</div>';        

            
        }

        function printImageText($count) {
            switch ($count) {
                case 1:
                    return "Easy to please";
                    break;
                case 2:
                    return "Down to earth";
                    break;
                case 3:
                    return "Aspiring cat lady";
                    break;
                case 4:
                    return "Cat enthusiast";
                    break;
                case 5:
                    return "You don't belong on this planet";
                    break;
                default:
                    return "Invalid count";
                    break;
            }
        }
        
        

        ob_start(); ?>

        <html>

        <head>

            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
                integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet"
                href="http://wp.docker.localhost:8000/wp-content/plugins/hamja-delusion-calculator/frontend/range.css" />

            <style>
            </style>

        </head>

        <body>

            <div class="flex items-center justify-center flex-col space-y-8 bg-black text-white p-12">
                <h1 style="font-size:80px" class="text-blue-400"> <?php echo $results["percentage"] ?> %</h1>
                <p>of all <?php echo $american_population['gender'] ?> in the United States meet your standards</p>
                <div class="flex bg-[#292929] p-4">
                    <p>That’s <?php echo number_format($matched_population) ?> of
                        <?php echo number_format($american_population['population']) ?> American
                        <?php echo $american_population['gender'] ?>
                    </p>
                </div>

                <!--- Heat Map Start -->
                <div>
                    <?php
                    $people_no = floor($results['percentage']);

                    $random = array();

                    if ($people_no > 0) {
                        for ($i = 0; $i <= $people_no; $i++) {
                            array_push($random, rand(50, 350));
                        }
                    }

                    for ($i = 0; $i <= 431; $i++) {
                        if (!empty($random) && in_array($i, $random)) {
                            echo "<i style='color:gold' class='fa-solid fa-person px-0.5 py-0.5'></i>";
                            // Remove the element from $random
                            $key = array_search($i, $random);
                            unset($random[$key]);
                        } else {
                            echo "<i style='color:rgb(15 23 42);' class='fa-solid fa-person px-0.5 py-0.5'></i>";
                        }
                    }

                    ?>

                </div>

                <div class="">
                    <center>
                        <h1 style="color:lightblue;" class="text-xl">Delusion Score</h1>
                        <div>
                            <?php printImages($results['percentage']) ?>
                        </div>
                    </center>
                </div>
            </div>
        </body>

        </html>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
        //   print_r($results);
    } else {
        // If form is not submitted, return an empty string
        return '<div class="items-center justify-center">No Result Found !</div>';
    }
}

// Register shortcode
add_shortcode('handle_delusion_calculator_form', 'handle_delusion_calculator_form');


?>