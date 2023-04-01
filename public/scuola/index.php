<!DOCTYPE html>
<html lang="en">

<?php

// Constanti base, prefissi di tutti gli URL riferiti nel documento
// (Se cambia la configurazione del reverse proxy non dobbiamo fare nessun refactoring)
define("AUTORE", getenv("NOME")); // Il mio nome e cognome son privati :3
define("BASE_URL", "https://localhost/scuola"); // URL che punta a questo file
define("ASSETS_URL", "https://localhost/assets"); // URL che contiene tutti gli assets

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UI kit -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= ASSETS_URL ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= ASSETS_URL ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= ASSETS_URL ?>/favicon/favicon-16x16.png">

    <title>Arsenale di Taranto</title>

    <?php
    // Per poter usare le constanti all'interno delle stringhe
    $baseURL = BASE_URL;
    $assetsURL = ASSETS_URL;
    $autore = AUTORE;

    // Configurazione
    $pagine = ["home", "storia"];

    // Se non c'è nessun parametro query "pagina", mostriamo la pagina default.
    if (!isset($_GET["pagina"]))
        $pagina = "home";
    else // Mostriamo la pagina ottenuta dal parametro query "pagina"
        $pagina = $_GET["pagina"];

    // Se la pagina non esiste, redirectiamo l'utente alla homepage. Evita attacchi di path manipulation.
    // (Usiamo include(), il che può portare all'esecuzione di altri file tramite percorsi modificati tipo "/../../")
    if (!in_array(strtolower($pagina), $pagine)) {
        header("Location: $baseURL");
        die();
    }
    ?>
</head>

<body>
    <!-- Hero è una classe CSS del framework bulma, ci permette di usare un layout di una navbar, un titolo e un sottotitolo -->
    <section class="hero is-info is-fullheight">
        <!-- Inizio navbar -->
        <div class="hero-head">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <!-- Icona di Taranto + testo Arsenale, all'inizio della Navbar -->
                <div class="navbar-brand">
                    <a class="navbar-item" href="<?= BASE_URL ?>">
                        <img src="<?= ASSETS_URL ?>/taranto.png" width="200%">
                        <p class="navbar-item">Arsenale</p>
                    </a>
                </div>

                <!-- Inseriamo tutte le tab all'interno della navbar -->
                <div id="mainBar" class="navbar-menu">
                    <div class="navbar-start">
                        <?php
                        // Iteriamo attraverso tutte le pagine, definite nel blocco PHP nella sezione <head>
                        foreach ($pagine as $i) {
                            // Inseriamo l'item applicando il link HREF e il nome user-friendly della pagina.
                            echo "<a class=\"navbar-item\" href=\"$baseURL/?pagina=" . $i . "\"> " . lowerFirst($i) . " </a>";
                        }
                        ?>
                    </div>

                    <!-- Verrà inserito alla fine della barra -->
                    <div class="navbar-end">
                        <p class="navbar-item">Realizzato da <?= AUTORE ?></p>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Fine navbar -->

        <!-- Inizio titolo e contenuti -->
        <div class="hero-body is-info">
            <div class="container has-text-centered">
                <!-- Inseriamo nel titolo il nome della pagina -->
                <p class="title">
                    Arsenale di Taranto -
                    <?= lowerFirst($pagina) ?>
                </p>
                <br />

                <!-- Includiamo tutti i contenuti della pagina richiesta -->
                <?php include("contenuti/$pagina.php"); ?>
            </div>
        </div>
        <!-- Fine titolo e contenuti -->

        <!-- Inizio footer -->
        <div class="hero-foot">
            <nav class="tabs is-boxed is-right">
                <!-- Inseriamo il logo e il mio nome -->
                <div class="navbar-brand">
                    <a class="navbar-item" href="<?= BASE_URL ?>">
                        <img src="<?= ASSETS_URL ?>/taranto.png" width="200%">
                    </a>
                </div>
                <p class="navbar-item">Realizzato da <?= AUTORE ?></p>
                <!-- Contenitore dei pulsanti stile navbar -->
                <div class="container">
                    <ul>
                        <?php
                        // Inseriamo tutti i pulsanti coi loro rispettivi URL
                        foreach ($pagine as $i) {
                            echo "<li><a href=\"$baseURL/?pagina=$i\">" . lowerFirst($i) . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Fine footer -->
    </section>
</body>

<?php
// Utils

function foto($foto)
{
    // Creiamo un div con la classe "columns", che è un flexbox centrato orizzontale in cui inseriremo le immagini.
    echo "<div class=\"columns is-centered\">";

    // Iteriamo tutte le immagini passate nel parametro $foto
    foreach ($foto as $i) {
        // Rimuoviamo alcuni parametri per rendere l'immagine centrata, il div "column" serve per posizionare l'immagine nel flexbox.
        echo "<div class=\"column\" style=\"flex-grow: unset; flex-basis: unset\">";
        // Classe image di Bulma
        echo "<figure class=\"image\">";
        // Inseriamo immagine e la ridimensioniamo per adattarla alla nostra pagina, curvando anche il bordo.
        echo "<img src=\"" . ASSETS_URL . "/$i\" 
                alt=\"Foto $i\" style=\"width: 474px; height: 314px; border-radius: 25px\"></img>";
        echo "</figure>";
        echo "</div>";
    }

    echo "</div>";
}

function lowerFirst($nome)
{
    // Trasforma una stringa in minuscolo e rende il primo carattere maiuscolo.
    return ucfirst(strtolower($nome));
}
?>

</html>