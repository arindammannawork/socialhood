<html>
    <title>Social Hood - Social Networking Site</title>

    <head>
        <!-- <meta charset="UTF-8"> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Experience social networking like never before with Social Hood, 
     where every user enjoys a personalized journey. Dive into your dedicated account page, 
     showcasing your profile, posts, and photos. Stay in the loop with a dynamic feed, 
     sharing your thoughts directly or exploring content from others. Enrich your expression by sharing photos with your
     posts, creating a vibrant community experience. Manage your account seamlessly in the Info tab, 
     fine-tuning profile details and privacy settings. Revisit your memories in the Photos tab, 
     a collection of shared moments. Explore the diverse world of Social Hood by visiting other users' 
     account pages. Forge personal connections through private messaging, 
     making Social Hood the ultimate destination for authentic social networking.">
        <meta name="keywords" content="Personalized Account Page,
        Dynamic Feed of Shared Posts,
        Expressive Content Sharing,
        Photo Enriched Posts,
        Account Information Management,
        Photo Collection on Account Page,
        Explore User Content,
        Private Messaging for Personal Connections,
        Social Networking Profile,
        Community Engagement Features">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- <link rel="stylesheet" href="style/style.css"> -->
        <!-- Dark theme css -->
        <link rel="stylesheet" href="style/darktheme_css/dark_style.css?t=<?php echo time(); ?>" id="theme">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- favicon -->
        <link rel="shortcut icon" href="logo/Social Hood logo4.png" type="image/png">
        <script src="https://kit.fontawesome.com/17a4e5185f.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <nav>
            <div class="menu-btn">
                <div class="bar bar1"></div>
                <div class="bar bar2"></div>
                <div class="bar bar3"></div>
            </div>
            <label class="logo"><a href="/"><img class="logo" src="logo/Social Hood logo1.png"></a></label>
            <!-- <ul>
                <img src="img/dark_img/MoonIcon.png" alt="Theme Icon" height="19" width="19" id="theme-icon"
                    id="theme-toggle" class="theme-button" onclick="changeIndexTheme()">
            </ul> -->
            <ul class="menu-items">

                <li class="menu-items-li"><a class="navv-item" href="feed.php"><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor" class="menu-icon">
                            <path fill-rule="evenodd"
                                d="M3.75 4.5a.75.75 0 0 1 .75-.75h.75c8.284 0 15 6.716 15 15v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75C18 11.708 12.292 6 5.25 6H4.5a.75.75 0 0 1-.75-.75V4.5Zm0 6.75a.75.75 0 0 1 .75-.75h.75a8.25 8.25 0 0 1 8.25 8.25v.75a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75v-.75a6 6 0 0 0-6-6H4.5a.75.75 0 0 1-.75-.75v-.75Zm0 7.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        Feed</a></li>
                <li class="menu-items-li">
                    <?php
                    if (isset($_SESSION['username']))
                    {
                        echo '<a class="navv-item" href="account.php?username=' . $_SESSION['username'] . '" "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="menu-icon">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                  </svg>Account</a>';
                    } else
                    {
                        echo '<a class="navv-item" href="account.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="menu-icon">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                  </svg>Account</a>';
                    }
                    ?>
                </li>
                <li class="menu-items-li">
                    <?php
                    if (!isset($_SESSION['username']))
                    {
                        echo '<a class="navv-item active" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="menu-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                      </svg>Login</a>';
                    } else
                    {
                        echo '<a class="navv-item" href="back/logout.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="menu-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                      </svg>Logout</a>';
                    }
                    ?>
                </li>
                <li class="menu-items-li"><a class="navv-item" href="about-us.php"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="menu-icon">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                        </svg>About Us</a></li>



            </ul>
        </nav>