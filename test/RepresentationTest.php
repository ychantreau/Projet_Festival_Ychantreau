<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Representation Test</title>
    </head>
    <body>
        <?php
        use modele\metier\Groupe;
        use modele\metier\Lieu;
        use modele\metier\Representation;
        require_once __DIR__ . '/../includes/autoload.php';
        echo "<h2>Test unitaire de la classe métier Representation</h2>";
        $id = 1;
        $unGroupe = new Groupe("g999","les Joyeux Turlurons","général Alcazar","Tapiocapolis" ,25,"San Theodoros","O");
        $unLieu = new Lieu('1', 'La Moria', 'Rue Jean-Michel',200000);
        $uneDate = ('2017-07-11');
        $uneHeureDebut = ('20:30');
        $uneHeureFin = ('22:00');
        $objet = new Representation($id, $unGroupe, $unLieu, $uneDate, $uneHeureDebut, $uneHeureFin);
        var_dump($objet);
        ?>
    </body>
</html>




