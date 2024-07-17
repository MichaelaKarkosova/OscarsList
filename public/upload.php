<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/classes/CsvHandler.php';
require_once __DIR__ . '/../src/classes/Oscar.php';

$twig = require __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $femaleFile = $_FILES['femaleFile']['tmp_name'];
    $maleFile = $_FILES['maleFile']['tmp_name'];

    $femaleHandler = new CsvHandler($femaleFile);
    $maleHandler = new CsvHandler($maleFile);

    $femaleData = $femaleHandler->parseCsv();
    $maleData = $maleHandler->parseCsv();

    $oscarData = new Oscar($femaleData, $maleData);

    $oscarOverview = $oscarData->getOscarsList();
    $bothAwardsMovies = $oscarData->getMoviesWithBothAwards();

    echo $twig->render('oscars.html.twig', ['oscarOverview' => $oscarOverview]);
    echo $twig->render('both-roles.html.twig', ['bothAwardsMovies' => $bothAwardsMovies]);
}
?>
