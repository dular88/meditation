<div class="sidebar">
    <div class="brand text-white"><?php echo ucfirst($_SESSION['role'])?> Panel</div>

    <a href="index.php"><i class="fa fa-address-book" aria-hidden="true"></i> Dashboard</a>
    <a href="meditation_center.php"><i class="fa fa-align-center" aria-hidden="true"></i> Meditation Centers</a>
    <a href="meditators.php"><i class="fa fa-user" aria-hidden="true"></i> Meditators</a>
    <a href="events.php"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a>
    <a href="books.php"><i class="fa fa-book" aria-hidden="true"></i> Books</a>
    <?php if($_SESSION['role'] === "admin"){ ?>
    <a href="users.php"><i class="fa fa-book" aria-hidden="true"></i> Users</a>
    <a href="states.php"><i class="fa fa-location-arrow" aria-hidden="true"></i>
 State</a>
    <a href="city.php"><i class="fa fa-map-marker" aria-hidden="true"></i> City</a>
        <?php } ?>
    <hr>

    <a href="logout.php" class="text-danger fw-bold text-white"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
</div>
