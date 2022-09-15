<!DOCTYPE html>
<html lang="de">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet'>
    <link rel="stylesheet" href="css/main.css">
    <title>johannes_esklony</title>
    <link href="/website/css/main.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
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
        <?php
        include "establish_connection.php";
        $get_art = "SELECT art_id, art_title, LEFT(art_text, 500) as preview_text, art_datePublished FROM Article ORDER BY art_datePublished DESC";
        $res = $conn->query($get_art);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                //$art_path = "Artikel/" . $row["Art_ID"] . ".html";
                $art_path = "Artikel/article_reader.php?ID=" . $row["art_id"];
                echo    "<a class=\"art_card\" href=\"{$art_path}\">" .
                    "<div class=\"Ueberschrift\">" .
                    $row["art_title"] .
                    "</div>" .
                    "<div class=\"Preview\">" .
                    $row["preview_text"] . "..." .
                    "</div>" .
                    "<div class=\"Datum\">" .
                    $row["art_datePublished"] .
                    "</div>" .
                    "</a>";
            }
        }
        ?>
        <div id="space"></div>
        more content further up
    </div>

<!-- 

    <footer>
        <a href="impressum.html">
            <span>Impressum</span>
        </a>
    </footer> -->

    <script src="main.js" ></script>
    <script src="/canvas.js"></script>
    <script src="/website/canvas.js"></script>
</body>

</html>