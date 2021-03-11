<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test-page</title>
  </head>
  <body>
    <p>This is a test page</p>
    <h3>The name is {{$name}} and
      <?php if ($g=="f"): ?>
        her
      <?php elseif ($g == "m"): ?>
        his
      <?php else: ?>
        
      <?php endif; ?>
    age is {{$age}}</h3>
  </body>
</html>
