<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
//        Visu pavardes
            $link = mysqli_connect("localhost", "root", '', 'naujadb');
            $sql = "SELECT NR, pavarde
            FROM vykdytojai";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo " " . $row['NR'] . ". " . $row['pavarde'] . "<br>";
        }
        echo "<br>";
//        Projektai ir juose dirbartys zmones
            echo " =Studentu apskaita=" . "<br>";
            $link = mysqli_connect("localhost", "root", '', 'naujadb');
            $sql = "SELECT vykdytojai.pavarde, projektai.Pavadinimas
            FROM vykdytojai JOIN vykdymas 
            ON vykdytojai.Nr=vykdymas.vykdytojas 
            JOIN projektai ON vykdymas.Projektas=projektai.Nr 
            WHERE pavadinimas='Studentu apskaita';";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "Projekte dirba: " . $row['pavarde'] . "<br>";
        }
            echo "<br>";
            echo " =Buhalterine apskaita=" . "<br>";
            $link = mysqli_connect("localhost", "root", '', 'naujadb');
            $sql = "SELECT vykdytojai.pavarde, projektai.Pavadinimas
            FROM vykdytojai JOIN vykdymas 
            ON vykdytojai.Nr=vykdymas.vykdytojas 
            JOIN projektai ON vykdymas.Projektas=projektai.Nr 
            WHERE pavadinimas='buhalterine apskaita';";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "Projekte dirba: " . $row['pavarde'] . "<br>";
        }   
            echo "<br>";
            echo " =WWW svetaine=" . "<br>";
            $link = mysqli_connect("localhost", "root", '', 'naujadb');
            $sql = "SELECT vykdytojai.pavarde, projektai.Pavadinimas
            FROM vykdytojai JOIN vykdymas 
            ON vykdytojai.Nr=vykdymas.vykdytojas 
            JOIN projektai ON vykdymas.Projektas=projektai.Nr 
            WHERE pavadinimas='www svetaine';";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "Projekte dirba: " . $row['pavarde'] . "<br>";
        } 
        
        // geras sprendimas
        echo "<br>";
        $sql = "SELECT PAVADINIMAS, PAVARDE FROM projektai JOIN vykdymas ON "
                . "vykdymas.PROJEKTAS=projektai.NR JOIN vykdytojai ON "
                . "vykdytojai.NR=vykdymas.VYKDYTOJAS;";
        $mysqli = mysqli_connect('localhost', 'root', '', 'naujadb');
        $result = mysqli_query($mysqli, $sql);
        $projectNames = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $projectNames[] = $row['PAVADINIMAS'];
        }
        $uniqueNames = array_unique($projectNames, SORT_STRING); //lieka 3 projektai.
        print_r($uniqueNames);
        echo "<br>";
        mysqli_data_seek($result, 0); // uzklausos kursoriaus nustatymas i pradzia.
        foreach ($uniqueNames as $unique) { // kiekvienam unikaliam projektui:
            echo "=" . $unique . "=<br>";   // jo vardo spausdinimas;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($unique == $row['PAVADINIMAS']) { // jei vardas atitinka einamaji -
                    echo $row['PAVARDE'] . "<br>";
                }
            }
        mysqli_data_seek($result, 0); // velgi kursoriaus grazinimas i pradzia
        }
        ?>
    </body>
</html>
