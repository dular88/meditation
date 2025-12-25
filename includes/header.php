<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-nav">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            <img src="assets/images/pssm.png" width="70" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainMenu">
            <ul class="navbar-nav mb-2 mb-lg-0">

                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="meditation_centers.php">Meditation Centers</a></li>
                <li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="books.php">Books</a></li>
                <li class="nav-item"><a class="nav-link" href="meditators.php">Meditators</a></li>

                <li class="nav-item ms-lg-3">
                    <a class="btn btn-warning btn-sm" href="contact.php">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<style>
    .navbar {
    background: rgba(0,0,0,0.65) !important;
}

.custom-nav{
    background: transparent;
}

body{
    padding-top: 80px;
}

/* Default navbar */
.custom-nav{
    background: rgba(0,0,0,0.65);
    transition: background 0.3s ease;
}

/* On scroll */
.custom-nav.scrolled{
    background: #000;
}

.navbar .nav-link,
.navbar .navbar-brand{
    color:#fff !important;
}

.navbar .nav-link:hover{
    color:#00ffcc !important;
}



    </style>