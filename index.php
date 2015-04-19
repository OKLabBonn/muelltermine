<!doctype html>
<html>
  <head>
    <title>Müllkalender</title>
    <meta charset="UTF-8" />
  </head>
  <body>
    <?php

    header('Content-Type: text/html; charset=utf-8');

    include_once "_db-connect.php";

    $userstreet = $_GET['userstreet'];
    $usernumber = $_GET['usernumber'];
    $debug = $_GET['debug'];
    ?>

    <h2>Straßen</h2>
    <form method="get" action="index.php">
      <?php $query = "SELECT strasse1, ort1, plz1 FROM muellkalender GROUP BY strasse1"; ?>
      <?php if ($result = $mysqli -> query($query)) : ?>
        <select name="userstreet">
          <?php while ($row = $result -> fetch_assoc()) : ?>
            <?php
              $selected = '';
              if ($row['strasse1'] === $userstreet) { $selected = 'selected'; };
            ?>
            <option value="<?php echo $row['strasse1']; ?>" <?php echo $selected; ?>><?php echo $row['strasse1']; ?>, <?php echo $row['plz1']; ?> <?php echo $row['ort1']; ?></option>
          <?php endwhile; ?>
        </select>

        <input type="text" name="usernumber" value="<?php echo $usernumber; ?>" />
        <input type="submit" />

      <?php endif; ?>
    </form>

    <h2>Termine</h2>
    <?php $query = "SELECT * FROM muellkalender WHERE strasse1 LIKE '" . $userstreet . "' LIMIT 100"; ?>

    <?php if ($userstreet && $usernumber && $result = $mysqli -> query($query)) : ?>
      <h3>... für <?php echo $userstreet; ?> <?php echo $usernumber; ?></h3>
      <table border="1">
        <tr>
          <th><!-- PLANUNGNR --></th>
          <th>PLAN_BEZ</th>
          <th><!-- PLAN_AB --></th>
          <th><!-- PLAN_BIS --></th>
          <th>AUFGTURNUS</th>
          <th><!-- STRABSCHNR --></th>
          <th><!-- STRASSE1 --></th>
          <th><!-- ORT1 --></th>
          <th><!-- PLZ1 --></th>
          <th><!-- HNR_GE_AB --></th>
          <th><!-- HNR_GE_BIS --></th>
          <th><!-- HNR_UG_AB --></th>
          <th><!-- HNR_UG_BIS --></th>
        </tr>

        <?php while ($row = $result -> fetch_assoc()) : ?>
          <?php

            $show = false;

            // Hausnummer überprüfen
            if ($usernumber % 2 == 0) {
              // echo "even";
              if ($usernumber >= $row['HNR_GE_AB'] && $usernumber <= $row['HNR_GE_BIS']) { $show = true; }

            } else {
              // echo "odd";
              if ($usernumber >= $row['HNR_UG_AB'] && $usernumber <= $row['HNR_UG_BIS']) { $show = true; }

            }
          ?>

            <?php if ($show || $debug) : ?>
              <tr>
                <td><?php //echo $row['PLANUNGNR']; ?></td>
                <td><?php echo $row['PLAN_BEZ']; ?></td>
                <td><?php //echo $row['PLAN_AB']; ?></td>
                <td><?php //echo $row['PLAN_BIS']; ?></td>
                <td><?php echo $row['AUFGTURNUS']; ?></td>
                <td><?php //echo $row['STRABSCHNR']; ?></td>
                <td><?php //echo $row['STRASSE1']; ?></td>
                <td><?php //echo $row['ORT1']; ?></td>
                <td><?php //echo $row['PLZ1']; ?></td>
                <td><?php //echo $row['HNR_GE_AB']; ?></td>
                <td><?php //echo $row['HNR_GE_BIS']; ?></td>
                <td><?php //echo $row['HNR_UG_AB']; ?></td>
                <td><?php //echo $row['HNR_UG_BIS']; ?></td>

                <?php for ($i = 0; $i <= 189; $i++) : ?>

                  <?php $i = str_pad($i, 3, "0", STR_PAD_LEFT); ?>

                  <?php if ($row['TERMIN' . $i] != '0000-00-00') : ?>

                    <?php $date = strtotime($row['TERMIN' . $i]); ?>

                    <td <?php if ($date < strtotime(date('Y-m-d'))) : ?>style="color: gray;"<?php endif; ?>>

                      <?php echo date('d.m.Y', $date); ?>

                    </td>

                  <?php endif; ?>

                <?php endfor; ?>

              </tr>
            <?php endif; ?>
        <?php endwhile; ?>
      </table>
    <?php else : ?>
        <p>Bitte eine Straße auswählen und eine Hausnummer angeben.</p>
    <?php endif; ?>
  </body>
</html>
