{extends file="main.tpl"}

{block name=content}
<!-- Header -->
		<header id="header">
			<a href="{$conf->root_path}/index.php" class="logo"><strong>Kalkulator</strong> <span>kredytowy</span></a>
		</header>
<form action="{$conf->action_url}login" method="post">
    <legend>Logowanie do systemu</legend>
    <fieldset>
        <label for="id_login">Login:</label>
        <input id="id_login" type="text" name="login"/>

        <label for="id_password">Password</label>
        <input id="id_password" type="password" name="password"/>

        <input type="submit" value="zaloguj" class="pure-button"/>
    </fieldset>
</form>

{include file='messages.tpl'}

{/block}