<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>Page Title</title>
  </head>
  <body>
    <h1>LOGIN</h1>
    <?php if(isset($error)): ?>
      <strong><?php print $error; ?></strong>
    <?php endif; ?>
    <form name="loginform" method="post" action="">  
      <input type="text" name="username" id="username" value="admin" />
      <input type="password" name="password" id="password" value="admin" />
      <input type="submit" name="Submit" value="Submit" />  
    </form>
  </body>
</html>