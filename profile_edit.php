<?php
session_start();

include "db_connection.php";

function sanetize_html($inputText){
    //This function needs improvements.
    return strip_tags($inputText);
}

$user = mysqli_query($db_conn, "SELECT Id, Username, Bio, Socials FROM users WHERE Id = " . $_SESSION["userId"]);
$userRows = $user->fetch_assoc();

$UserId = $userRows["Id"];
$Username = $userRows["Username"];
$Bio = sanetize_html($userRows["Bio"]);
$Socials = $userRows["Socials"];

?>

<!DOCTYPE HTML>
<html lang="en">

<?php include 'Templates/head.html' ;?>

<body>
<?php include 'Templates/header.html' ;?>

<p>Current user id: <?php echo $UserId ?></p>

<form action="edit_profile.php" method="post" id="profileform">
    Username: <input type="text" name="Username" value="<?php echo $Username ?>">
    Bio: <textarea name="Bio" form="profileform"><?php echo $Bio ?></textarea>
    Twitter: <input type="text" name="SocialsTwitter">
    Discord: <input type="text" name="SocialsDiscord">
    <input type="submit">
</form>

</body>

</html