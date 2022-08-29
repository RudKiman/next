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
<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Имя</th>
        <th scope="col">Отчество</th>
        <th scope="col">ИИН</th>
        <th scope="col">Номер удостоверения</th>
        <th scope="col">Дата выдачи</th>
        <th scope="col">Кем выдано</th>
        <th scope="col">Юр.лицо</th>
        <th scope="col">Название организации</th>
        <th scope="col">БИН</th>
        <th scope="col">БИК</th>
        <th scope="col">Юр.адрес</th>
    </tr>
<?php foreach($cntr as $row):?>
<tr>
<td> <?php echo $row["id"];?> </td>
<td> <?php echo $row["name"];?> </td>
<td> <?php echo $row["surname"];?> </td>
<td> <?php echo $row["patron"];?> </td>
<td> <?php echo $row["iin"];?> </td>
<td> <?php echo $row["passnum"];?> </td>
<td> <?php echo $row["issdate"];?> </td>
<td> <?php echo $row["issby"];?> </td>
<td> <?php echo $row["issent"];?> </td>
<td> <?php echo $row["entname"];?> </td>
<td> <?php echo $row["bin"];?> </td>
<td> <?php echo $row["bik"];?> </td>
<td> <?php echo $row["intadress"];?>  </td>
<td>
  <div class="dropdown">
  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Действие
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="editcntr.php">Изменить</a></li>
    <li><a class="dropdown-item" href="delcntr.php">Удалить</a></li>
  </ul>
</div>
</td>
</tr>
<?php endforeach; ?>
  </table>
</div>
  <div>
    <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
  </div>

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
