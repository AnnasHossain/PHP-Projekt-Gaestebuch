<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./style/lib/montserrat/webfonts/Montserrat.css" />
    <link rel="stylesheet" type="text/css" href="./style/main.css" />
    <title>Gästebuch</title>
</head>
<body>
<div class="container">
    <h1 class="guestbook-heading">Gästebuch</h1>
    <?php if (!empty($_GET['success'])): ?>
        <h2>Eintrag erfolgreich abgeschickt</h2>
    <?php endif; ?>
    <form method="POST" action="submit.php">
        <?php if(isset($errorMessage)): ?>
            <p><?php echo e($errorMessage); ?></p>
        <?php endif; ?>
        <label class="guestbook-entry-label" for="name">Dein Name:</label>
        <input
                required="required"
                class="guestbook-entry-input"
                type="text"
                id="name"
                name="name" />

        <label class="guestbook-entry-label" for="title">Titel des Eintrags:</label>
        <input
                required="required"
                class="guestbook-entry-input"
                type="text"
                id="title"
                name="title" />

        <label class="guestbook-entry-label" for="content">Inhalt des Eintrags:</label>
        <textarea
                required="required"
                rows="4"
                class="guestbook-entry-input"
                type="text"
                id="content"
                name="content"></textarea>

        <div class="guestbook-form-buttons">
            <input class="button" type="reset" value="Zurücksetzen">
            <input class="button" type="submit" value="Absenden">
        </div>
    </form>

    <hr class="guestbook-separator" />

<!--    <pre><?php /*print_r($entries); */?></pre>
-->
    <?php foreach($entries AS $entry): //$entries kommt von index.php aus Zeile 41?>
        <?php
        $paragraphs = explode("\n", $entry['content']);
        $filteredParagraphs = [];
        foreach ($paragraphs AS $paragraph) {
            $paragraph = trim($paragraph);
            if (strlen($paragraph) > 0) {
                $filteredParagraphs[] = $paragraph;
            }
        }
        ?>
        <div class="guestbook-entry">
            <div class="guestbook-entry-header">
                <h3 class="guestbook-entry-title">
                    <?php echo e($entry['title']); ?>
                </h3>
                <span class="guestbook-entry-author">
                        <?php echo e($entry['name']); ?>
                    </span>
            </div>
            <div class="guestbook-entry-content">
                <?php foreach($filteredParagraphs AS $p): ?>
                    <p><?php echo e($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?><!--


    <?php /*var_dump($perPage); */?><br />
    --><?php /*var_dump($countTotal) */?>

    <?php
    $numPages = ceil($countTotal / $perPage);
//    var_dump($numPages);

    ?>

    <?php if($numPages > 1): ?>
    <ul class="guestbook-pagination">
        <?php for($x = 1; $x <= $numPages; $x++): ?>
            <li class="guestbook-pagination-li">
                <a
                        class="guestbook-pagination-a<?php if($x === $currentPage): ?> guestbook-pagination-active<?php endif; ?>"
                        href="index.php?<?php echo http_build_query(['page' => $x]); ?>">

                    <?php echo e($x); ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
    <?php endif; ?>

    <hr class="guestbook-separator" />
</div>


<footer class="guestbook-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Über Uns</h3>
            <p>Dieses Gästebuch wurde im Rahmen eines PHP-Kurses entwickelt. Es dient als Übungsprojekt für Webentwicklung.</p>
        </div>
        <div class="footer-section">
            <h3>Kontakt</h3>
            <p>Email: support@example.com</p>
            <p>Telefon: +49 123 456 789</p>
        </div>
        <div class="footer-section">
            <h3>Rechtliches</h3>
            <p>Impressum | Datenschutz</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 Gästebuch-Projekt. Alle Rechte vorbehalten.</p>
    </div>
</footer>

</body>
</html>
