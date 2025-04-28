<?php
/* Smarty version 5.4.2, created on 2025-04-28 13:31:18
  from 'file:PersonEdit.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_680f670664d256_95334652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '506c9d0fc25bce98eddf0d7ec553583406c26679' => 
    array (
      0 => 'PersonEdit.tpl',
      1 => 1745761471,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_680f670664d256_95334652 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\xampp\\htdocs\\projekt6\\app\\views';
?><!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8"/>
    <title>Edytuj Osobę</title>

    <link rel="stylesheet"
          href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"
          integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w"
          crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/css/main.css"/>
</head>
<body class="is-preload">

<header>
    <nav>
            <a href="<?php echo $_smarty_tpl->getValue('app_url');?>
/index.php?action=logout">Wyloguj się</a>
    </nav>
</header>

<main class="content">
    <h2>Edytuj Osobę</h2>

    <form class="pure-form pure-form-aligned"
          action="<?php echo $_smarty_tpl->getValue('app_url');?>
/index.php?action=personSave"
          method="post">

        <fieldset>
            <legend>Dane Osoby</legend>

            <div class="pure-control-group">
                <label for="name">Imię</label>
                <input id="name"
                       type="text"
                       name="name"
                       placeholder="Imię"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')['name'], ENT_QUOTES, 'UTF-8', true);?>
">
            </div>

            <div class="pure-control-group">
                <label for="surname">Nazwisko</label>
                <input id="surname"
                       type="text"
                       name="surname"
                       placeholder="Nazwisko"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')['surname'], ENT_QUOTES, 'UTF-8', true);?>
">
            </div>

            <div class="pure-control-group">
                <label for="birthdate">Data ur.</label>
                <input id="birthdate"
                       type="date"
                       name="birthdate"
                       placeholder="YYYY-MM-DD"
                       value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')['birthdate'], ENT_QUOTES, 'UTF-8', true);?>
">
            </div>

            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary">
                    Zapisz
                </button>
                <a href="<?php echo $_smarty_tpl->getValue('app_url');?>
/index.php?action=personList"
                   class="pure-button button-secondary">
                    Powrót
                </a>
            </div>
        </fieldset>

        <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
    </form>
</main>

<footer>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.scrolly.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>$(function(){ $('.scrolly').scrolly(); });<?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/jquery.scrollex.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/browser.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/util.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('app_url');?>
/assets/js/main.js"><?php echo '</script'; ?>
>
</footer>

</body>
</html>
<?php }
}
