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
<p>Current username: <?php echo $Username ?></p>
<p></p>
<form>
    <textarea>
        <?php echo $Bio ?>
    </textarea>
    <input type="submit" value="Save changes to bio">
</form>

<p>Socials</p>
<ul>
    <script>
        let Socials = JSON.parse(`<?php echo $Socials ?>`)
        Socials.forEach(social => {
            if(social[1] !== ""){
                document.write(`<li>${social[0]} - ${social[1]}</li>`)
            }
        })
    </script>
</ul>


</body>

</html