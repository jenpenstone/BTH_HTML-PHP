<!-- Default page if no multipage is chosen. -->
<h2><?=$page["title"]?></h2>

<fieldset class="accessField">
    <form class="access" id="loginForm" method="post" action="?page=login-processing">
        <label for="user">Användarnamn: </label>
        <input type="text" name="user" id="user">

        <label for="password">Lösenord: </label>
        <input type="password" name="password" id="password">

        <input type=submit name="login" value="Logga in">
    </form>

</fieldset>
