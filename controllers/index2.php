
<html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    h1 {
        color: #2c3e50;
    }

    p {
        font-size: 18px;
    }
</style>


<?php
include 'functions/fn.php';
$books = [
    [
    "title" => "The Hitchhiker's Guide to the Galaxy",
    "author" => "Douglas Adams",
    "year" => 1979
    ],
    [
    "title" => "1984",
    "author" => "George Orwell",
    "year" => 1949
    ],
    [
    "title" => "To Kill a Mockingbird",
    "author" => "Harper Lee",
    "year" => 1960
    ],
    [
    "title" => "The Great Gatsby",
    "author" => "Harper Lee",
    "year" => 1925
    ]

];
$read = true;

if ($read){
    $message = "You have read \"{$books[1]['title']}\" by {$books[1]['author']} published in {$books[1]['year']}.";
}
    else {
    $message = "You have not read \"{$books['title']}\"";
}

echo $message;

######################## filter by the author ########################



// foreach (filterByAuther($books,'Douglas Adams') as $book) {
//     echo "<h1>{$book['title']}</h1>";
//     echo "<p>Author: {$book['author']}</p>";
//     echo "<p>Year: {$book['year']}</p>";
//     echo "<hr>";
// }

###################### general filter fun ########################

// foreach (filter($books, "author",'Harper Lee') as $book) {
//     echo "<h1>{$book['title']}</h1>";
//     echo "<p>Author: {$book['author']}</p>";
//     echo "<p>Year: {$book['year']}</p>";
//     echo "<hr>";
// }


###################### general filter fun and the condition didn`t determine in the function ########################



foreach (generalFilter($books, function ($book) {
    return $book['author'] == 'Harper Lee';
}) as $book) {    echo "<h1>{$book['title']}</h1>";
    echo "<p>Author: {$book['author']}</p>";
    echo "<p>Year: {$book['year']}</p>";
    echo "<hr>";
}


######################### array_filter() ########################


// foreach (array_filter($books, function ($book) {
//     return $book['author'] == 'Harper Lee';
// }) as $book) {    echo "<h1>{$book['title']}</h1>";
//     echo "<p>Author: {$book['author']}</p>";
//     echo "<p>Year: {$book['year']}</p>";
//     echo "<hr>";
// }

?>

</html>