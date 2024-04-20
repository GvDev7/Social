<!DOCTYPE html>
<?php
include("includes/headers.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])){
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
    header("Location: index.php");
}

?>
    <div class="user_details column">
        <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user_detail['profile_pic'] ?>" alt=""></a>
        <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>">
            <?php 
            echo $user_detail['first_name'] . " " . $user_detail[ 'last_name'];  
            ?>
            <br>
            </a>
            <?php echo "Posts: " . $user_detail['num_post']. "<br>" ; 
                echo "Likes: " . $user_detail['num_likes'];
            ?>
        </div>
    </div>
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_btn" value="Post">
            <hr>
        </form>
        <?php 
        $user_obj = new User($con, $userLoggedIn);
        echo $user_obj->getFirstAndLastName();
        ?>
    </div>

</div>
</body>
</html>