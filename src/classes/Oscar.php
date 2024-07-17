<?php

class Oscar
{
    private $femaleData;
    private $maleData;
    private $awards = [];
    private $movies = [];

    public function __construct($femaleData, $maleData) {
        $this->femaleData = $femaleData;
        $this->maleData = $maleData;
        $this->processData();
    }

    private function processData() {
        foreach ($this->femaleData as $index => $row) {
            if ($index == 0 || count($row) < 5) continue;
            $year = $row[1];
            $this->awards[$year]['female'] = [
                'name' => $row[3] ?? 'N/A',
                'age' => $row[2] ?? 'N/A',
                'movie' => $row[4] ?? 'N/A'
            ];
            $this->movies[$row[4]]['year'] = $year;
            $this->movies[$row[4]]['female'] = $row[3];
        }

        foreach ($this->maleData as $index => $row) {
            if ($index == 0 || count($row) < 5) continue;
            $year = $row[1];
            $this->awards[$year]['male'] = [
                'name' => $row[3] ?? 'N/A',
                'age' => $row[2] ?? 'N/A',
                'movie' => $row[4] ?? 'N/A'
            ];
            $this->movies[$row[4]]['year'] = $year;
            $this->movies[$row[4]]['male'] = $row[3];
        }
    }

    public function getOscarsList() {
        $overview = [];
        foreach ($this->awards as $year => $winners) {
            $female = isset($winners['female']) ? $winners['female']['name'] . " (".trim($winners['female']['age']).")" . "<br>" . $winners['female']['movie'] : '';
            $male = isset($winners['male']) ? $winners['male']['name']." (".(trim($winners['male']['age'])).")" . "<br>" . $winners['male']['movie'] : '';
            $overview[] = [
                'year' => $year,
                'female' => $female,
                'male' => $male
            ];
        }
        return $overview;
    }

    public function getMoviesWithBothAwards() {
        $bothAwardsMovies = array_filter($this->movies, function($movie) {
            return isset($movie['female']) && isset($movie['male']);
        });
        uasort($bothAwardsMovies, function($a, $b) {
            return strcmp($a['year'], $b['year']);
        });

        return $bothAwardsMovies;
    }
}
?>
