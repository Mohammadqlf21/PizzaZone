<?php session_start(); ?>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Pizza Store!!</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        

        <div class="all_of_it">
            
        <div class="video">
            <video autoplay muted loop>
                <source src="../css/pics/PizzaVid.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="container">
            
            <h2>Welcome to Pizza Zone 🍕</h2>
            
            <?php
                if (isset($_SESSION['login_error'])) {
                    echo '<p style="color:red; font-weight:bold; margin-bottom: 10px;">' . $_SESSION['login_error'] . '</p>';
                    unset($_SESSION['login_error']);
                }
                $form_data = $_SESSION['form_data'] ?? ['email' => ''];
                unset($_SESSION['form_data']);
            ?>
            
            

            <div class="buttons">
                <form action="../php/login.php" method="POST">
                    <input type="email" name="email" placeholder="Email" id="email" value="<?= htmlspecialchars($form_data['email']) ?>" required>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    
                    <!-- htmlspecialchars is used to safely display user input in HTML. --> 
                    
                
                    <div class="btn-group">
                        <button type="submit" class="login">Login</button>
                         <button type="button" class="signup" onclick="window.location.href='signup_form.php'">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="mini-gif">
                <video autoplay loop muted >
                  <source src="../css/pics/Animation.mp4" type="video/mp4">
                  
                </video>
                
              </div>
              <div class="guest">
                <br><br>
                <a href="#" onclick="viewAsGuest()">View as a Guest</a>
            </div>
        </div>
        
    </div>

    <div class="bottom-space">
    
</div>
<script>     function viewAsGuest() {
    window.location.href = "logout.php";
}
</script>
    </body>

</html>