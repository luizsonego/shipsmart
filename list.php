<?php

require './config/db.php';

?>

<table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Endereço</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Sexo</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $pdo = Db::connect();
          $sql = 'SELECT * FROM pessoa ORDER BY id DESC';

          foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<th scope="row">' . $row['id'] . '</th>';
            echo '<td>' . $row['nome'] . '</td>';
            echo '<td>' . $row['endereco'] . '</td>';
            echo '<td>' . $row['telefone'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['sexo'] . '</td>';
            echo '<td width=250>';
            echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
            echo ' ';
            echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
            echo ' ';
            echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Excluir</a>';
            echo '</td>';
            echo '</tr>';
          }
          Db::disconnect();
          ?>
        </tbody>
      </table>