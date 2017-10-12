<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lieu Test</title>
    </head>
    <body>
        <?php
        use modele\metier\Lieu;
        use modele\metier\Groupe;
        require_once __DIR__ . '/../includes/autoload.php';
        echo "<h2>Test unitaire de la classe métier Lieu</h2>";
        $unLieu = new Lieu('1', 'La Moria', 'Rue Jean-Michel',200000);
        $objet = $unLieu;
        var_dump($objet);
        ?>
    </body>
</html>


