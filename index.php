<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize the data array
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch and decode the response from the API
    $raw_response = file_get_contents($URL);
    $response = json_decode($raw_response, true);
    
    // Assign results to the data array
    if (isset($response['results'])) {
        $data = $response['results'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#Assignment2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="font-sans">
    <div class="max-h-[400px] overflow-y-auto -webkit-overflow-scrolling-touch mt-5 border border-blue-300 rounded-md px-5">
        <table class="w-full border-separate border-spacing-0">
            <thead class="sticky top-0 z-10">
                <tr>
                    <?php
                    $columns = ['Year', 'Semester', 'The Programs', 'Nationality', 'Colleges', 'No. Of Students'];
                    foreach ($columns as $column) {
                        echo "<th class='p-3 text-left bg-blue-100 font-bold text-blue-800 border-b border-blue-300'>$column</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <tr class="even:bg-blue-50 hover:bg-blue-100">
                        <?php
                        $fields = ['year', 'semester', 'the_programs', 'nationality', 'colleges', 'number_of_students'];
                        foreach ($fields as $field) {
                            echo "<td class='p-3 border-b border-blue-300' data-label='" . ucfirst(str_replace('_', ' ', $field)) . "'>";
                            echo htmlspecialchars($item[$field]);
                            echo "</td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
