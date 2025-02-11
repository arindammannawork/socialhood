<?php
session_start();
if (isset($_SESSION["username"]))
{
    header("Location: feed.php");
    exit;
}
?>
<?php
include './components/navbar.php'; //previously made footer part
?>

<!-- <div class="seperate_header"></div> -->
<!-- <div class="navbar">
        <ul>
            <li>
                <img class="logo" src="logo\logo.png">
            </li>
            <li class="nav-item">
                <a href="feed.php" style="text-decoration: none">Feed</a>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['username']))
                {
                    echo '<a href="account.php?username=' . $_SESSION['username'] . '" style="text-decoration: none">Account</a>';
                } else
                {
                    echo '<a href="account.php" style="text-decoration: none">Account</a>';
                }
                ?>
            </li>
            <li class="nav-item">
                <?php
                if (!isset($_SESSION['username']))
                {
                    echo '<a href="/" style="text-decoration: none;">Login</a>';
                } else
                {
                    echo '<a href="back/logout.php"  style="text-decoration: none;">Logout</a>';
                }
                ?>
            </li>
        </ul>
    </div> -->

<div class="login-signup-wraper">

    <div class="login-signup">
        <center><img class="login-logo" src="logo/logo.png" alt="logo"></center>
        <center><small><button class="btn"
                    onclick="getElementById('login-form').style.display='block'; getElementById('regst-form').style.display='none';">Login</button>OR<button
                    class="btn"
                    onclick="getElementById('login-form').style.display='none'; getElementById('regst-form').style.display='block';">Register</button></small>
        </center>
        <div class="login">
            <form action="db/validate.php" method="post" class="login-form" id="login-form">
                <input type="text" for="usrname" id="username" autocomplete="off" name="username" placeholder="Username"
                    required>
                <input type="password" for="password" id="password" name="password" placeholder="Password"
                    autocomplete="off" required>
                <button class="login-btn" name="lgn" id="lgn">Login Now</button>
            </form>
        </div>
        <div class="register">
            <form action="db/validate.php" method="post" class="regst-form" id="regst-form" style="display: none;">
                <input type="text" for="usrname" id="usrname" name="username" placeholder="Username" autocomplete="off"
                    required>
                <section class="name">
                    <input type="text" for="fname" id="fname" name="fname" placeholder="First name" required
                        pattern="[a-zA-Z]{2,}$" title="please enter alphabets only">
                    <input type="text" for="lname" id="lname" name="lname" placeholder="Last name" required
                        pattern="[a-zA-Z]{2,}$" title="please enter alphabets only">
                </section>
                <input type="email" for="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="pass" name="password" placeholder="Password" required>
                <!--only show for password input -->
                <div class="div-toggle-password">
                    <button id="togglePassword">Show</button>
                    <!-- <small id="kindOfPassword" hidden>
                                <span>🔒 size > 8 </span>
                                <span>🔠 Uppercase </span>
                                <span>🔡 Lowercase </span>
                                <span>🔢 Number </span>
                                <span>@!$# Special Character</span>
                            </small> -->
                </div>
                <small style="margin-bottom: 6px;">Your data will be used to provide you with the seamless experience.
                    We respect your
                    privacy</small>
                <button class="rgst-btn" name="regst" id="regst">Register</button>
                <!-- Handle password input -->
                <script>
                const passwordInput = document.getElementById('pass');
                const registerButton = document.getElementById('regst');
                //only for password
                const toggleButton = document.getElementById('togglePassword');
                const kindOfPassword = document.getElementById('kindOfPassword');
                const fnameInput = document.getElementById('fname');
                const lnameInput = document.getElementById('lname');
                // passwordInput.addEventListener("input", () => {
                //     //empty password field
                //     if (passwordInput.value === "") {
                //         passwordInput.classList.remove('valid-password', 'invalid-password');
                //         registerButton.disabled = true;
                //         registerButton.style.cursor = "not-allowed";    //change cursor to not-allowed
                //         toggleButton.hidden = true;
                //         kindOfPassword.hidden = true;
                //     } else {    //non-empty password field
                //         const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; //means a-z, A-Z, 0-9, @$!%*?& and min 8 characters
                //         if (passwordPattern.test(passwordInput.value)) {    //check if password is valid
                //             passwordInput.classList.remove('invalid-password');
                //             passwordInput.classList.add('valid-password');
                //             registerButton.disabled = false;     
                //             registerButton.style.cursor = "pointer";   //enable register button    
                //             toggleButton.hidden = false;            //hide password toggle button
                //             kindOfPassword.hidden = false;
                //         } else {    //invalid password
                //             passwordInput.classList.remove('valid-password');
                //             passwordInput.classList.add('invalid-password');
                //             registerButton.disabled = true;                 //disable register button
                //             registerButton.style.cursor = "not-allowed";    //change cursor to not-allowed
                //             toggleButton.hidden = false;
                //             kindOfPassword.hidden = false;
                //         }
                //     }
                // });
                // //toggle password visibility

                toggleButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    toggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
                });
                </script>

            </form>
        </div>
    </div>
</div>

<?php
include './components/footer.php'; //previously made footer part
?>