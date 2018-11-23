<?php function draw_sidebar_login() { 

  if (isset($_SESSION['username']))
  { 
    $username = $_SESSION['username'];?>
    <section id="sidebar_login">
        
        <a href="../pages/profile.php?user=<?= $username ?>"><?= $username ?></a>
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
        <div><a href="../pages/signup.php?message=">Signup</a></div>
        </form>

    </section>
    <?php }
 } ?>

<?php function draw_login($message) { 
/**
 * Draws the login section.
 */ ?>
  <section id="login">

      <h1>Log In</h1>
      <h2><?= $message ?></h2>

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

      <h1>Create an account today!</h1>
      <?php if($message !== "") {?>
      <h2><?= $message ?></h2>
      <?php }?>

    <form method="post" action="../actions/action_signup.php">
      <input type="text" name="username" placeholder="username" autocomplete="new-username" required>
      <input type="password" name="password" placeholder="password" autocomplete="new-password" required>
      <input type="password" name="repeat_password" placeholder="repeat password" autocomplete="new-repeat_password" required>
      <input type="submit" value="Signup">
    </form>

    <footer>
      <p>Already have an account? <a href="login.php">Login!</a></p>
    </footer>

  </section>
<?php } ?>