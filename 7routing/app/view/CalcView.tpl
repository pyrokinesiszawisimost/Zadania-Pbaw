{extends file="main.tpl"}

{block name=content}
<!-- Header -->
		<header id="header">
			<a href="{$conf->root_path}/index.php" class="logo"><strong>Kalkulator</strong> <span>kredytowy</span></a>
			<a href="{$conf->action_url}logout" style="float:right">wyloguj</a>
		</header>

<h2>Kalkulator kredytowy</h2>


<div>
	<form action="{$conf->action_url}calcCompute" method="post">
		<fieldset>
			<label for="id_kwota">Podaj kwotę:</label>
			<input id="id_kwota" type="text" placeholder="wartość kwoty" name="kwota" value="{$form->kwota}">
			<label for="id_years">Podaj ilość lat:</label>
			<input id="id_years" type="text" placeholder="liczba lat" name="years" value="{$form->years}">
			<label for="id_proc">Podaj oprocentowanie:</label>
			<input id="id_proc" type="text" placeholder="wartość oprocentowania" name="proc" value="{$form->proc}">
			<br>
			<button type="submit" class="pure-button">Oblicz</button>
		</fieldset>
	</form>
</div>
	<div style="display:flex; justify-content:space-between">
	{include file='messages.tpl'}
		<div>
			{if isset($result->res)}
				<h4>Wynik</h4>
				<p>
					{$result->res}
				</p>
			{/if}
		</div>
	</div>


{/block}