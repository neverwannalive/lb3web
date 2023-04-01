<?php include "conn.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запит 3</title>
</head>
<body>
<?php
    $author = $_GET['author'];
    $literate = "Book";
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHRS 
        on $db.LITERATURE.ID = $db.BOOK_AUTHRS.FID_BOOK
        JOIN $db.AUTHOR
        on $db.BOOK_AUTHRS.FID_AUTH= $db.AUTHOR.ID
        where $db.LITERATURE.LITERATE = :literate and $db.AUTHOR.name = :author");
    $sqlSelect->execute(array('literate' => $literate, 'author' => $author));
    
    echo "<table border ='1'>";
    echo "<tr><th>Name</th><th>Author</th><th>Publisher</th><th>Year</th><th>ISBN</th></tr>";
    while($cell=$sqlSelect->fetch(PDO::FETCH_BOTH)){
        echo "<tr><td>$cell[1]</td><td>$author</td><td>$cell[4]</td><td>$cell[3]</td><td>$cell[6]</td></tr>";
    }
    echo "</table>";
?>
</body>
</html>