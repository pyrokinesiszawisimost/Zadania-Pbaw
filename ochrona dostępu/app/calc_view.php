<?php

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Kalkulator</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator</legend>
	<fieldset>
		<label for="id_kredyt">Kwota: </label>
		<input id="id_kredyt" type="text" name="kredyt" value="<?php out($kredyt) ?>" /><br />
		<label for="id_okr_kr">Ilosc lat: </label>
		<input id="id_okr_kr" type="text" name="okr_kr" value="<?php out($okr_kr) ?>" /><br />
		<label for="id_opr">Oprocentowanie: </label>
		<input id="id_opr" type="text" name="opr" value="<?php out($opr) ?>" /><br />
    </fieldset>
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

<?php

if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($miesiecznaRata)){ ?>
<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
<?php echo 'Miesięczna rata wynosi: '.$miesiecznaRata. ' zł'; ?>
</div>
<?php } ?>

</div>

</body>
</html>
