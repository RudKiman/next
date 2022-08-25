<?php
$title="Контрагенты";
require __DIR__ . '/php/header.php';
require __DIR__ . '/php/db.php';
$data = $_POST;

if(isset($data['create_cntprt'])) {

	$errors = array();


	if(trim($data['name']) == '') {

		$errors[] = "Введите имя";
	}

	if(trim($data['surname']) == '') {

		$errors[] = "Введите Фамилию";
	}

	if($data['iin'] == '') {

		$errors[] = "Введите ИИН";
	}

  if($data['passnum'] == '') {

		$errors[] = "Введите номер паспорта";
	}

  if($data['issdate'] == '') {

    $errors[] = "Укажите дату выдачи";
  }

  if($data['issby'] == '') {

    $errors[] = "Не указано кем выдан документ";
  }

	if(mb_strlen($data['iin']) < 11 || mb_strlen($data['iin']) > 12) {

	    $errors[] = "Слишком короткий ИИН";

    }

  if (mb_strlen($data['passnum']) < 8 || mb_strlen($data['passnum']) > 9){

	    $errors[] = "Слишком короткий номер удостоверения";

    }

	if(R::count('counterparty', "iin = ?", array($data['iin'])) > 0) {

		$errors[] = "Контрагент с таким ИИН уже существует";
	}

	if(R::count('counterparty', "passnum = ?", array($data['passnum'])) > 0) {

		$errors[] = "Контрагент с таким номером паспорта уже существует!";
	}

	if(empty($errors)) {

		$counterparty = R::dispense('counterparty');

		$counterparty->name = $data['name'];
		$counterparty->surname = $data['surname'];
		$counterparty->patron = $data['patron'];
		$counterparty->iin = $data['iin'];
    $counterparty->passnum = $data['passnum'];
		$counterparty->issdate = $data['issdate'];
		$counterparty->issby = $data['issby'];
    $counterparty->isent = $data['isent'];
    $counterparty->entname = $data['entname'];
    $counterparty->bin = $data['bin'];
    $counterparty->bik = $data['bik'];
    $counterparty->intadress = $data['intadress'];



		R::store($counterparty);

        header('Location: cntr.php');

	} else {
 echo '<script type="text/javascript">alert(" ' . implode("; ", $errors) . '");</script>';
	}
}
?>

<div class="container my-4">
		<div class="row">
			<div class="col">
		<h2>Добавление контрагента</h2><br>
		<form action="addcntr.php" method="post">
			Введите фамилию <input type="text" class="form-control" name="surname" id="surname" required><br>
			Введите имя <input type="text" class="form-control" name="name" id="name" required><br>
			Введите отчество <input type="text" class="form-control" name="patron" id="patron" placeholder=""><br>
			Введите ИИН <input type="number" class="form-control" name="iin" id="iin" placeholder="" required><br>
			Введите номер удостоверения <input type="number" class="form-control" name="passnum" id="passnum" placeholder="" required><br>
			Укажите дату выдачи <input type="date" class="form-control" name="issdate" id="issdate" placeholder="" max="2022-12-31" required><br>
			Укажите кем выдан документ <input type="text" class="form-control" name="issby" id="issby" placeholder="" required><br>
			Контрагент является юр.лицом<br>
			  <input class="form-check-input" type="radio" onclick="isentitycheck();" name="isent" id="yes" value="1" checked>
			  <label class="form-check-label" for="yes">
			    Да
			  </label><br>
			  <input class="form-check-input" type="radio" onclick="isentitycheck();" name="isent" id="no" value="0">
			  <label class="form-check-label" for="no">
			    Нет
			  </label><br>
			<br>
			<div id="isentcheck">
			Название организации <input type="text" class="form-control" name="entname" id="entname"><br>
      БИН <input type="text" class="form-control" name="bin" id="bin"><br>
      БИК <input type="text" class="form-control" name="bik" id="bik"><br>
      Юридический адрес <input type="text" class="form-control" name="intadress" id="intadress"><br>
			</div>
			<button style="margin: 20px 800px 0px 0px" class="btn btn-primary" name="create_cntprt" type="submit">Добавить</button>
  		</form>
  			</div>
  		</div>
</div>
<?php require __DIR__ . '/php/footer.php'; ?>
