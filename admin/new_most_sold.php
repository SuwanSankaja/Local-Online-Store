
<!DOCTYPE html>
<html>
<head>
    <title> most Sold Items </title>
    <style>
        table {border-collapse: collapse;}
        td,th{border: 1px solid black ;padding: 5px;}
    </style>
</head>

<body>
    <h2> Most Sold Items in a Given Time </h2>
    <form action="most_sold_search.php" method="post">
        <input type="date" name="from">
        <input type="date" name="to">
        <input type="submit" value="Search">

    </form>

</body>
</html>
