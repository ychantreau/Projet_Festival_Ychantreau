<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>GroupeDAO : test</title>
    </head>

    <body>

        <?php
        use modele\metier\Groupe;
        use modele\dao\GroupeDAO;
        use modele\dao\Bdd;

require_once __DIR__ . '/../includes/autoload.php';

        $id = 'g010';
        Bdd::connecter();

        echo "<h2>Test GroupeDAO</h2>";

        // Test n°1
        echo "<h3>Test getOneById</h3>";
        try {
            $objet = GroupeDAO::getOneById($id);
            var_dump($objet);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°2
        echo "<h3>Test getAll</h3>";
        try {
            $lesObjets = GroupeDAO::getAll();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°3
        echo "<h3>Test getAllToHost</h3>";
        try {
            $lesObjets = GroupeDAO::getAllToHost();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }
        
        
        // Test n°3
        echo "<h3>3- insert</h3>";
        try {
            $id = 'g500';
            $objet = new Groupe($id, 'La Joliverie', '141 route de Clisson', 'ouais', 12, 'ICI', 'O');
            $ok = GroupeDAO::insert($objet);
            if ($ok) {
                echo "<h4>ooo réussite de l'insertion ooo</h4>";
                $objetLu = GroupeDAO::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de l'insertion ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°4
        echo "<h3>4- update</h3>";
        try {
            $objet->setNom('changement');
            $objet->setAdresse('nouvelle adresse');
            $ok = GroupeDAO::update($id, $objet);
            if ($ok) {
                echo "<h4>ooo réussite de la mise à jour ooo</h4>";
                $objetLu = GroupeDAO::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de la mise à jour ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°5
        echo "<h3>5- delete</h3>";
        try {
            $ok = GroupeDAO::delete($id);
//            $ok = GroupeDAO::delete("xxx");
            if ($ok) {
                echo "<h4>ooo réussite de la suppression ooo</h4>";
            } else {
                echo "<h4>*** échec de la suppression ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        Bdd::deconnecter();
        ?>


    </body>
</html>
