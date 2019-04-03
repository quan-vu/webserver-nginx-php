<?php

$pdo = new PDO('mysql:host=mysql;dbname=world;charset=utf8', 'root', 'root');

$stmt = $pdo->prepare("
    select city.Name, city.District, country.Name as Country, city.Population
    from city
    left join country on city.CountryCode = country.Code
    order by Population desc
    limit 10
");
$stmt->execute();
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vultr Rocks!</title>
</head>
<body>
    <h2>Most Populous Cities In The World</h2>
    <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>District</th>
            <th>Population</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cities as $city): ?>
            <tr>
                <td><?=$city['Name']?></td>
                <td><?=$city['Country']?></td>
                <td><?=$city['District']?></td>
                <td><?=number_format($city['Population'], 0)?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    </table>
</body>
</html>