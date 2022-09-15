<?php
require_once './pdo_ini.php';
require_once '../web/functions.php';

$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
const PAGE_LIMIT = 20;

$sth = $pdo->prepare('SELECT DISTINCT LEFT(name, 1) AS name FROM airports ORDER BY name');
$sth->setFetchMode(\PDO::FETCH_COLUMN, 0);
$sth->execute();
$uniqueFirstLetters = $sth->fetchAll();

$queryWhere = [];
if (isset($_GET['filter_by_first_letter'])) {
    array_push($queryWhere, 'airports.name LIKE \'' . $_GET['filter_by_first_letter'] . '%\'');
}

if (isset($_GET['filter_by_state'])) {
    array_push($queryWhere, 'states.name = \'' . $_GET['filter_by_state'] . '\'');
}

$sql = 'SELECT 
    airports.name, 
    airports.code, 
    airports.address, 
    airports.timezone, 
    states.name AS state_name,
    cities.name AS city_name 
    FROM airports 
    INNER JOIN states ON airports.state_id = states.id 
    INNER JOIN cities ON airports.city_id = cities.id';

if (count($queryWhere)) {
    $sql .= ' WHERE ' . implode(' AND ', $queryWhere);
}

if (isset($_GET['sort'])) {
    $sql .= ' ORDER BY ' . $_GET['sort'] . ' ASC';
}

$sth = $pdo->prepare($sql);
$sth->execute();
$countAfterSelects = $sth->rowCount();
$countPages = (int)ceil($countAfterSelects / PAGE_LIMIT);

$offset = ($page === 1) ? 0 : $page * PAGE_LIMIT - PAGE_LIMIT;
$sql .= ' LIMIT ' . PAGE_LIMIT . ' OFFSET ' . $offset;
$sth = $pdo->prepare($sql);
$sth->execute();

$airports = $sth->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <main role="main" class="container">
        <h1 class="mt-5">US Airports</h1>
        <div class="alert alert-dark">
            Filter by first letter:
            <?php foreach ($uniqueFirstLetters as $letter) : ?>
                <a href="<?= addParams(['filter_by_first_letter' => $letter, 'page' => 1]) ?>">
                    <?= $letter ?>
                </a>
            <?php endforeach; ?>

            <a href="?" class="float-right">Reset all filters</a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'name']) ?>">Name</a></th>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'code']) ?>">Code</a></th>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'state_name']) ?>">State</a></th>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'city_name']) ?>">City</a></th>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'address']) ?>">Address</th>
                <th scope="col"><a href="<?php echo addParams(['sort' => 'timezone']) ?>">Timezone</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($airports as $airport) : ?>
                <tr>
                    <td><?= $airport['name'] ?></td>
                    <td><?= $airport['code'] ?></td>
                    <td><a href="<?= addParams(['filter_by_state' => $airport['state_name']], ['page' => 1]); ?>">
                            <?= $airport['state_name'] ?></a></td>
                    <td><?= $airport['city_name'] ?></td>
                    <td><?= $airport['address'] ?></td>
                    <td><?= $airport['timezone'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <nav aria-label="Navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 0; $i < $countPages; $i++) : ?>
                    <li class="page-item <?= $page == $i + 1 ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo addParams(['page' => $i + 1]) ?>"><?= $i + 1 ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </main>
</html>
