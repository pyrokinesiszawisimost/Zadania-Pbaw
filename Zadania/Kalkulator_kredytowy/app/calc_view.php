<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_kredyt"> Kwota: </label>
	<input id="id_kredyt" type="text" name="kredyt" value="<?php print($kredyt); ?>" /><br />
	<label for="id_okr_kr">Ilość lat: </label>
	<input id="id_okr_kr" type="text" name="okr_kr" value="<?php print($okr_kr); ?>" /><br />
	<label for="id_opr">Oprocentowanie: </label>
	<input id="id_opr" type="text" name="opr" value="<?php print($opr); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($miesiecznaRata)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna rata wynosi: '.$miesiecznaRata. ' zł'; ?>
</div>
<?php } ?>

</body>
</html>