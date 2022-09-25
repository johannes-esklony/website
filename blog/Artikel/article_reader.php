<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'>
    <link rel="stylesheet" href="css/main.css">
    <title>johannes_esklony</title>
    <link href="/website/css/main.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/website/blog/css/blog.css" rel="stylesheet">
    <link href="/blog/css/blog.css" rel="stylesheet">
</head>

<body>
    <nav>
        
        <a href="" id="topleft" white-space="pre-line">Johannes Esklony - Blog</a>
        <div id="navlinks">
            <div id="searchbar">
                <form>
                    <input type="search" aria-label="Search">
                    <button type="submit">Search</button>
                </form>
            </div>
            <a href="/" >to homepage</a>            
        </div>
    </nav>

    <canvas id="backgroundanimation"></canvas>


    <div id="content" style="overflow-y: scroll;">
        <!-- get all the blog posts -->
        <?php
            include "establish_connection.php";
            $art_id = $_GET['ID'];
            $sql_q = "SELECT art_title, art_text, art_datePublished, user_name FROM Article LEFT JOIN User ON Article.user_id = User.user_id WHERE Article.art_id={$art_id}";
            $article_q = $conn->query($sql_q);
            if ($article_q->num_rows > 0) {
                while ($row = $article_q->fetch_assoc()) {
                    
                    echo   
                        "<div class=\"Ueberschrift\">" .
                        $row["art_title"] .
                        "</div>" .
                        "<div class=\"inhalt\">" .
                        $row["art_text"] .
                        "</div>" .
                        "<div class=\"Datum\">" .
                        $row["art_datePublished"] .
                        "</div>"
                        ;
                }
            }
        ?>
    </div>

    <!-- not in use -->
    <!-- <script src="/blog/main.js" ></script> -->
    <!-- <script src="/website/blog/main.js" ></script> -->

    <!-- for the background animation -->
    <script src="/canvas.js"></script>
    <script src="/website/canvas.js"></script>
</body>

</html>