<?php
include("db/connection.php");
include("back/env.php");

// starting session
session_start();

// redirecting user if not logged-in
if (!isset($_SESSION['username']) || !isset($_GET['username']))
{
    echo "
    <script>
        alert('Error occurred please Login to continue');
        window.location = '$home_page';
    </script>
    ";
}
$username = $_GET['username'];
$sql = "SELECT `id`,`username`, `fname`, `lname`, `email`,`profile_pic`,`cover_pic` FROM `users` WHERE `username` ='$username';";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);

?>

<?php
include './components/navbar.php'; //previously made footer part
?>
<main class="main">

    <div class="chat-body">

        <div class=" friend-req-box" id="friend-req-<?php echo $row['username']; ?>">
            <div class="content">
                <div class="left">
                    <a href="account.php?username=<?php echo $row['username']; ?>" style="text-decoration: none;">
                        <img src="<?php echo $row['profile_pic'] ? "uploads/" . $row['profile_pic'] : "https://api.dicebear.com/6.x/initials/png?seed=" . $row['fname'] . "&size=128"; ?>"
                            alt="profile_pic" class="account-profpic">
                    </a>
                    <a href="account.php?username=<?php echo $row['username']; ?>"
                        style="text-decoration: none;"><?php echo $row['fname'] . " " . $row['lname']; ?></a>
                </div>
            </div>

        </div>
        <div class="chat-box" id="chat-box">
            <div class="message received">Hey! How are you?</div>
            <div class="message sent">I'm good! How about you?</div>
            <div class="message received">I'm doing great. What’s up?</div>
        </div>
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>
</main>
<script>
    async function fetchChat(fromUsername, toUsername) {
        try {
            let response = await fetch(`backend/get-chat.php?from_username=${fromUsername}&to_username=${toUsername}`);
            let data = await response.json();
            // console.log(data);
            showChats(data)


            // let chatContainer = document.getElementById("chat-container");
            // chatContainer.innerHTML = ""; // Clear previous messages


        } catch (error) {
            console.error("Error fetching chat:", error);
        }
    }

    // Example usage
    // fetchChat('john_doe', 'jane_doe');
    document.addEventListener("DOMContentLoaded", function () {

        let fromUsername = "<?php echo $_SESSION['username']; ?>"; // Logged-in user
        let toUsername = "<?php echo $_GET['username']; ?>"; // Chat partner
        fetchChat(fromUsername, toUsername);
        setInterval(() => {
            fetchChat(fromUsername, toUsername);
        }, 500); // Fetch new messages every second
    });

    let old_sent_at = null;

    function showChats(data) {
        let fromUsername = "<?php echo $_SESSION['username']; ?>"; // Logged-in user
        let toUsername = "<?php echo $_GET['username']; ?>"; // Chat partner
        let chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = ""; // Clear previous messages
        data.forEach(({
            from_username,
            to_username,
            message,
            sent_at
        }) => {
            // console.log(sent_at);

            chatBox.innerHTML +=
                `<div class="message ${(fromUsername == from_username) ? "sent" : "received"}">${message}</div>`
        });
        // console.log(data[data.length - 1]);
        let sent_at = data[data.length - 1].sent_at;
        if (old_sent_at !== sent_at) {

            chatBox.scrollTop = chatBox.scrollHeight;
            old_sent_at = sent_at;
        }
    }




    // send chat 

    document.addEventListener("DOMContentLoaded", function () {
        let fromUsername = "<?php echo $_SESSION['username']; ?>"; // Logged-in user
        let toUsername = "<?php echo $_GET['username']; ?>"; // Chat partner
        document.getElementById("sendBtn").addEventListener("click", function () {
            sendChat(fromUsername, toUsername);
        });

        document.getElementById("messageInput").addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                sendChat(fromUsername, toUsername);
            }
        });

        async function sendChat(fromUsername, toUsername) {
            let messageInput = document.getElementById("messageInput");
            let message = messageInput.value.trim();

            if (message === "") return;

            let formData = new FormData();
            formData.append("from_username", fromUsername);
            formData.append("to_username", toUsername);
            formData.append("message", message);

            try {
                let response = await fetch("backend/send-chat.php", {
                    method: "POST",
                    body: formData
                });

                let result = await response.json();

                if (result.success) {
                    messageInput.value = ""; // Clear input field
                    fetchChat(fromUsername, toUsername); // Refresh chat
                } else {
                    console.error("Message sending failed");
                }

            } catch (error) {
                console.error("Error sending chat:", error);
            }
        }
    });
</script>
<?php
include './components/footer.php'; //previously made footer part
?>