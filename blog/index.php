<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newsweit</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <nav>
        
        <a class="navbar-brand" href="index.php">blog</a>
        <div id="searchbar">
            <form class="d-flex">
                <input class="form-control me-2" type="search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div>
        <?php
        include "establish_connection.php";
        $get_art = "SELECT id, titel, LEFT(inhalt, 500) as inhalt, Datum FROM Artikel ORDER BY Datum DESC";
        $res = $conn->query($get_art);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                //$art_path = "Artikel/" . $row["Art_ID"] . ".html";
                $art_path = "Artikel/article_reader.php?ID=" . $row["id"];
                echo    "<a class=\"Art card\" href=\"{$art_path}\">" .
                    "<div class=\"Ueberschrift\">" .
                    $row["titel"] .
                    "</div>" .
                    "<div class=\"Preview\">" .
                    $row["inhalt"] . "..." .
                    "</div>" .
                    "<div class=\"Datum\">" .
                    $row["Datum"] .
                    "</div>" .
                    "</a>";
            }
        }
        ?>
    </div>


    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <a class="col-md-4 d-flex align-items-center" href="impressum.html">
            <span class="text-muted">Impressum</span>
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="main.js" ></script>
</body>

</html>