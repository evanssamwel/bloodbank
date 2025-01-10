<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("config/connection.php");
include("includes/fetch_users_info.php");
include("includes/time_function.php");
include("includes/num_k_m_count.php");

// Check user authentication
if (!isset($_SESSION['Username'])) {
    header("Location: index");
    exit;
}

// Determine image directory path
if (is_dir("imgs/")) {
    $check_path = "";
} elseif (is_dir("../imgs/")) {
    $check_path = "../";
} elseif (is_dir("../../imgs/")) {
    $check_path = "../../";
}
?>

<p class="BB"><?php echo lang('recently_starts_from'); ?></p>

<?php
// Fetch recent logins
$mYiD = $_SESSION['user'];
$getS_sql = "SELECT * FROM login ORDER BY id DESC LIMIT 5";
$getS = $conn->prepare($getS_sql);
$getS->execute();

while ($getS_row = $getS->fetch(PDO::FETCH_ASSOC)) {
    $getuserid = $getS_row['u_id'];

    // Fetch user details by ID
    $getuser_sql = "SELECT user FROM login WHERE id = :user";
    $getuser = $conn->prepare($getuser_sql);
    $getuser->bindParam(':user', $getuserid, PDO::PARAM_INT);
    $getuser->execute();

    while ($getuser_row = $getuser->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <a href="u/<?php echo htmlspecialchars($getuser_row['user']); ?>">
            <p class="<?php echo htmlspecialchars(lang('HLP_b')); ?>">
                <?php echo htmlspecialchars($getuser_row['user']); ?>
            </p>
        </a>
        <?php
    }
}
?>
<a href="./u/<?php echo htmlspecialchars($_SESSION['user']); ?>&ut=stars">
    <p class="<?php echo htmlspecialchars(lang('HLP_b')); ?>">Link to Stars</p>
</a>
