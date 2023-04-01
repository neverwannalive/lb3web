<?php include "conn.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запит 1</title>
</head>
<body>
<?php
    $publisher = $_GET['publisher'];
    $literate = "Book";
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHRS 
        on $db.LITERATURE.ID = $db.BOOK_AUTHRS.FID_BOOK
        JOIN $db.AUTHOR
        on $db.BOOK_AUTHRS.FID_AUTH = $db.AUTHOR.ID
        where $db.LITERATURE.LITERATE = :literate and $db.LITERATURE.publisher = :publisher");
    $sqlSelect->execute(array('literate' => $literate, 'publisher' => $publisher));
    
    echo "<table border ='1'>";
    echo "<tr><th>Name</th><th>ISBN</th><th>Publisher</th><th>Year</th><th>Count</th></tr>";
    while($cell=$sqlSelect->fetch(PDO::FETCH_BOTH)){
        echo "<tr><td>$cell[1]</td><td>$cell[6]</td><td>$cell[4]</td><td>$cell[3]</td><td>$cell[5]</td></tr>";
    }
    echo "</table>";
?>
</body>
</html>