<!DOCTYPE>
<html>
<style>
body  {background-color: #b0c4de;}
h1 {text-align: center;}
q {text-align: center;}

</style>
<body>
<br>
<br>
<table width="300" border="1" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form action="check_login.php" method="post">
<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>

<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr>

<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Division</td>
<td width="6">:</td>
<td width="294"><input type="text" name="division" required="required"/></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input type="text" name="username" required="required"/></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td> <input type="password" name="password" required="required" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" value="Login"/></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>