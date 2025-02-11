<?php
include("back/env.php");

// starting session only when $_session is set
session_start();
include("db/connection.php");
$username = $_SESSION['username'];

// redirecting user if not logged-in
if (!isset($_SESSION['username']))
{
    echo "
    <script>
        alert('Error occurred please Login to continue');
        window.location = '$home_page';
    </script>
    ";
    exit;
} else
{
    $sql = "SELECT `id`,`username`, `fname`, `lname`, `email`,`profile_pic`,`cover_pic` FROM `users` WHERE `username` ='$username';";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $username_row = $row['username'];
    $user_id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $profile_pic = $row['profile_pic'];
    $cover_pic = $row['cover_pic'];
}
?>

<?php
include './components/navbar.php'; //previously made footer part
?>


<main class="main">
    <div class="account">
        <div class="account-body">
            <?php
            if ($cover_pic == null)
            { ?>
                <div class="account-banner" style="background-image: url('logo/banner2.jpg');">
                    <?php
            } else
            { ?>
                    <div class="account-banner" style="background-image: url('uploads/<?php echo $cover_pic; ?>');">
                        <!-- <img src="uploads/<?php echo $profile_pic; ?>" alt="profile" class="account-profpic"> -->
                        <?php
            }
            ?>

                    <div class="account-img">
                        <ul>

                            <li>
                                <?php
                                if ($profile_pic == null)
                                { ?>
                                    <img src="https://api.dicebear.com/6.x/initials/png?seed=<?php echo $fname ?>&size=128"
                                        alt="profile" class="account-profpic">
                                    <?php
                                } else
                                { ?>
                                    <img src="uploads/<?php echo $profile_pic; ?>" alt="profile" class="account-profpic">
                                    <?php
                                }
                                ?>
                            </li>
                            <li style="padding-left: 10px;">

                                <div class="message-buttons-name">
                                    <?php
                                    echo "<b>$fname</b>";
                                    echo "<small>@$username_row</small><br>";
                                    ?>

                                </div>

                            </li>
                            <li>
                            </li>
                        </ul>
                    </div>
                </div>




            </div>
        </div>
        <div class="login-signup edit-form">

            <form action="backend/edit-account-backend.php" method="post">
                <div class="edit-form-div">
                    <div class="label">

                        <label for="">Cover Image</label>
                    </div>
                    <input onchange="onchangeInput(event)" type="file" name="cover_pic" accept=".jpg, .png, .jpeg"
                        class="postimage">
                    <div class="label">
                        <label for="">Profile Image</label>
                    </div>
                    <input type="number" name="id" value="<?php echo $user_id; ?>" hidden>
                    <input onchange="onchangeInput(event)" type="file" name="profile_pic" accept=".jpg, .png, .jpeg"
                        class="postimage">
                    <input onchange="onchangeInput(event)" type="text" for="usrname" id="usrname" name="username"
                        placeholder="Username" autocomplete="off" required="">
                    <input onchange="onchangeInput(event)" type="text" for="fname" id="fname" name="fname"
                        placeholder="First name" required="" pattern="[a-zA-Z]{2,}$"
                        title="please enter alphabets only">
                    <input onchange="onchangeInput(event)" type="text" for="lname" id="lname" name="lname"
                        placeholder="Last name" required="" pattern="[a-zA-Z]{2,}$" title="please enter alphabets only">

                    <input onchange="onchangeInput(event)" type="email" for="email" id="email" name="email"
                        placeholder="Email" required="">
                    <input onchange="onchangeInput(event)" type="password" id="pass" name="password"
                        placeholder="Password" required="">
                    <div class="div-toggle-password">
                        <button id="togglePassword">Show</button>

                    </div>

                    <button class="rgst-btn" type="submit" name="editAccount">Save</button>

            </form>

            <!-- </form> -->
        </div>
    </div>
</main>
<script>
    // let username_row = <?php echo json_encode($username_row); ?>;
    let userData = {
        username: <?php echo json_encode($username); ?>,
        user_id: <?php echo json_encode($user_id); ?>,
        fname: <?php echo json_encode($fname); ?>,
        lname: <?php echo json_encode($lname); ?>,
        email: <?php echo json_encode($email); ?>,
        password: "",
        profile_pic: <?php echo json_encode($profile_pic); ?>,
        cover_pic: <?php echo json_encode($cover_pic); ?>,
        redirect: "account.php"
    }


    function onchangeInput(event) {
        let name = event.target.name;
        console.log(event);

        if (name === 'profile_pic' || name == "cover_pic") {

        } else {

            userData[name] = event.target.value
        }
        showData();
    }

    function showData(fromOnchange) {
        let profile_pic_file = document.querySelector('input[name="profile_pic"]').files[0];
        let cover_pic_file = document.querySelector('input[name="cover_pic"]').files[0];
        if (profile_pic_file) {
            document.querySelector('.account-profpic').setAttribute("src", URL.createObjectURL(profile_pic_file));
        } else {
            document.querySelector('.account-profpic').setAttribute("src", `uploads/${userData.profile_pic}`);
        }
        if (cover_pic_file) {
            document.querySelector('.account-banner').style.backgroundImage =
                `url("${URL.createObjectURL(cover_pic_file)}")`;
        } else {
            document.querySelector('.account-banner').style.backgroundImage = `url("uploads/${userData.cover_pic}")`;
        }

        document.querySelector('input[name="username"]').value = userData.username;
        document.querySelector('input[name="fname"]').value = userData.fname;
        document.querySelector('input[name="lname"]').value = userData.lname;
        document.querySelector('input[name="email"]').value = userData.email;
        document.querySelector('input[name="password"]').value = userData.password;

    }
    showData();

    const passwordInput = document.getElementById('pass');
    const registerButton = document.getElementById('regst');
    const toggleButton = document.getElementById('togglePassword');
    const kindOfPassword = document.getElementById('kindOfPassword');
    const fnameInput = document.getElementById('fname');
    const lnameInput = document.getElementById('lname');


    toggleButton.addEventListener('click', (e) => {
        e.preventDefault();
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleButton.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>
<?php
include './components/footer.php'; //previously made footer part
?>