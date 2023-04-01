<?php include "conn.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запит 2</title>
</head>
<body>
<?php
    $year_min = $_GET['year_min'];
    $date_max = $_GET['year_max'];
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHRS 
        on $db.LITERATURE.ID = $db.BOOK_AUTHRS.FID_BOOK
        JOIN $db.AUTHOR
        on $db.BOOK_AUTHRS.FID_AUTH = $db.AUTHOR.ID
        where $db.LITERATURE.year >= :year_min and $db.LITERATURE.year <= :year_max");
    $sqlSelect->execute(array('year_min' => $year_min, 'year_max' => $date_max));
    echo "<table border ='1'>";
    echo "<tr><th colspan = 6>Книги, журналы, газеты в диапазоне $year_min-$date_max</th></tr>
    <tr><th>Type</th><th>Name</th><th>Author</th><th>Publisher</th><th>Year</th><th>ISBN</th></tr>";
    while($cell=$sqlSelect->fetch(PDO::FETCH_BOTH)){
        echo "<tr><td>$cell[8]</td><td>$cell[1]</td><td>$cell[13]</td><td>$cell[4]</td><td>$cell[3]</td><td>$cell[6]</td></tr>";
    }
    echo "</table>";
?>
</body>
</html>