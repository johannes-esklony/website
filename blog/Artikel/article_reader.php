<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-md-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">news_weit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/about.html">About</a>
                    </li>
                <!--                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown
                                        </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                    </li>
                -->
                    <li class="nav-item">
                        <a class="nav-link disabled">Kontakt</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="content card">
        <?php
            include "establish_connection.php";
            $art_id = $_GET['ID'];
            $sql_q = "SELECT titel, untertitel, inhalt, datum, vorname, nachname FROM Artikel LEFT JOIN Artikel_Redakteure ON Artikel.id = Artikel_Redakteure.Artikel_id LEFT JOIN Redakteure ON Artikel_Redakteure.Redakteure_id = Redakteure.id WHERE Artikel.id={$art_id}";
            $article_q = $conn->query($sql_q);
            if ($article_q->num_rows > 0) {
                while ($row = $article_q->fetch_assoc()) {
                    
                    echo    
                        "<div class=\"Ueberschrift\">" .
                        $row["titel"] .
                        "</div>" .
                        "<div class=\"inhalt\">" .
                        $row["inhalt"] .
                        "</div>" .
                        "<div class=\"Datum\">" .
                        $row["datum"] .
                        "</div>" 
                        ;
                }
            }
        ?>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <a class="col-md-4 d-flex align-items-center" href="/impressum.html">
            <span class="text-muted">Impressum</span>
        </a>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>