<?php function draw_sidebar_login() { 

  if (isset($_SESSION['username']))
  { 
    $username = $_SESSION['username'];?>
    <section id="sidebar_login">
        
        <a href="../pages/signup.php/?user=<?= $username ?>"><?= $username ?></a>
        <div><a href="../actions/action_logout.php">Logout</a></div>

    </section>
  <?php }
  else
  { ?>
    <section id="sidebar_login">
        
        <form method="post" action="../actions/action_login.php">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="Login">
        <div><a href="../actions/action_logout.php">Signup</a></div>
        </form>

    </section>
    <?php }
 } ?>

<?php function draw_login($message) { 
/**
 * Draws the login section.
 */ ?>
  <section id="login">
    
    <header><h2>$message</h2></header>

    <form method="post" action="../actions/action_login.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Login">
    </form>

    <footer>
      <p>Don't have an account? <a href="signup.php">Signup!</a></p>
    </footer>

  </section>
<?php } ?>

<?php function draw_signup($message) { 
/**
 * Draws the signup section.
 */ ?>
  <section id="signup">

    <header><h2>$message</h2></header>

    <form method="post" action="../actions/action_signup.php">
      <input type="text" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Signup">
    </form>

    <footer>
      <p>Already have an account? <a href="login.php">Login!</a></p>
    </footer>

  </section>
<?php } ?>