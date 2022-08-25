<?php
$title="Контрагенты";
require __DIR__ . '/php/header.php';
require __DIR__ . '/php/db.php';
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$limit = 15;
$cntr = R::findAll('counterparty', 'ORDER BY id ASC LIMIT '.(($page-1)*$limit).', '.$limit);
$allRecords = R::count( 'counterparty' );
$totalPages = ceil($allRecords / $limit);
$prev = $page - 1;
$next = $page + 1;
?>

  <table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>ИИН</th>
        <th>Номер удостоверения</th>
        <th>Дата выдачи</th>
        <th>Кем выдано</th>
        <th>Юр.лицо</th>
        <th>Название организации</th>
        <th>БИН</th>
        <th>БИК</th>
        <th>Юр.адрес</th>
    </tr>
<?php
    foreach($cntr as $row){
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["surname"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["patron"] . "</td>";
        echo "<td>" . $row["iin"] . "</td>";
        echo "<td>" . $row["passnum"] . "</td>";
        echo "<td>" . $row["issdate"] . "</td>";
        echo "<td>" . $row["issby"] . "</td>";
        echo "<td>" . $row["isent"] . "</td>";
        echo "<td>" . $row["entname"] . "</td>";
        echo "<td>" . $row["bin"] . "</td>";
        echo "<td>" . $row["bik"] . "</td>";
        echo "<td>" . $row["intadress"] . "</td>";
        echo "</tr>";
    }
?>
  </table>
      <nav aria-label="Page navigation example mt-5">
          <ul class="pagination justify-content-center">
              <li class="page-item <?php if ($page <= 1) {
                                          echo 'disabled';
                                      } ?>">
                  <a class="page-link" href="<?php if ($page <= 1) {
                                                  echo '#';
                                              } else {
                                                  echo "?page=" . $prev;
                                              } ?>">Назад</a>
              </li>
              <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                  <li class="page-item <?php if ($page == $i) {
                                              echo 'active';
                                          } ?>">
                      <a class="page-link" href="cntr.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                  </li>
              <?php endfor; ?>
              <li class="page-item <?php if ($page >= $totalPages) {
                                          echo 'disabled';
                                      } ?>">
                  <a class="page-link" href="<?php if ($page >= $totalPages) {
                                                  echo '#';
                                              } else {
                                                  echo "?page=" . $next;
                                              } ?>">Вперед</a>
              </li>
          </ul>
      </nav>
<?php require __DIR__ . '/php/footer.php'; ?>
