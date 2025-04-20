<?php

######################## filter by the author ########################

function filterByAuther($books, $author){
    foreach($books as $book){
        if ($book['author']==$author){
            $filterBooks[]= $book;
        }
    }
    return $filterBooks;
}



###################### general filter fun ########################

function filter($books, $key, $value){
    foreach ($books as $book) {
        if ($book[$key] == $value) {
            $filterBooks[] = $book;
        }
    }
    return $filterBooks;
}


###################### general filter fun and the condition didn`t determine in the function ########################

function generalFilter($books, $fn){
    foreach ($books as $book){
      if ($fn($book)){
        $filterBooks[] = $book;
      }
    }   
    return $filterBooks;
}