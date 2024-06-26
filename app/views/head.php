<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" />

    <link rel="stylesheet" href="css/fitnessApp.css">

    <?php
    $currentPage = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $currentPage = pathinfo($currentPage, PATHINFO_FILENAME);

    
    if (!str_starts_with($currentPage, 'api/')) {
        // Set default CSS file
        $defaultCssFile = 'fitnessApp.css';

        // Adjust CSS file based on the current page
        switch ($currentPage) {
            case '':
                $cssFile = 'Home.css';
                break;
            case 'blog':
                $cssFile = 'blog.css';
                break;
            case 'progresstracker':
                $cssFile = 'ProgressTracker.css';
                break;
            case 'login':
                $cssFile = 'login.css';
                break;
            case 'signup':
                $cssFile = 'signup.css';
                break;
            default:
                $cssFile = $defaultCssFile;
                break;
        }
        echo '<link rel="stylesheet" href="css/' . $cssFile . '">';

    }
    ?>


</head>

<body>