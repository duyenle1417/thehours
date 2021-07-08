<!-- MODEL POST -->
<?php
require_once(ROOT_PATH . "/include/config.php");

class Comment
{
    // get number of comment(s) of post
    public function getCommentsNumberOfPost($id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE post_id = $id";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result);
    }

    // get comments of post
    public function getCommentsOfPost($post_id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE post_id = $post_id";
        $result = mysqli_query($conn, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($comments as $comment) {
            array_push($final, $comment);
        }

        return mysqli_num_rows($result);
    }

    // get paretn comments
    public function getParentCommentsOfPost($post_id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE post_id = $post_id AND parent_comment_id IS NULL";
        $result = mysqli_query($conn, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($comments as $comment) {
            array_push($final, $comment);
        }

        return $final;
    }

    // get replies of comment id
    public function getRepliesOfComment($parent_comment_id)
    {
        global $conn;
        $sql = "SELECT * FROM comments WHERE parent_comment_id = $parent_comment_id";
        $result = mysqli_query($conn, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($comments as $comment) {
            array_push($final, $comment);
        }

        return $final;
    }

    // get multi-level comment's list
    public function ShowReplies($comment_id, $replies, $post_id)
    {
        if (count($replies) > 0) {?>
            <ul class="reply">
            <?php
            foreach ($replies as $reply) {?>
            <li>
                <div class="comment-content">
                <div class="logo">
                    <span><i class="fas fa-comment-dots"></i></span> 
                </div>
                <p><?php echo $reply['content']; ?></p>
                </div>
                
                <?php
                if (isset($_SESSION['user_id'])) {
                    ?>
                <a href="#" class="reply-btn">Trả lời</a>
                <div class="reply_form" style="display: none;">
                    <form action="#comment-list" method="POST">
                        <input type="text" name="post_id" id="post_id" hidden value="<?php echo $post_id; ?>">
                        <input type="text" name="user_id" id="user_id" hidden value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="text" name="parent_comment_id" id="parent_comment_id" hidden value="<?php echo $reply['id'] ?>">

                        <textarea name="content" id="content" placeholder="Trả lời..."></textarea>
                        <input type="submit" name="add-reply" id="add-reply" value="Trả lời">
                    </form>
                </div>
                <?php
                }
                ?>
                <?php
                    // đệ quy lấy replies
                    $replies_temp = $this->getRepliesOfComment($reply['id']);
                    $this->ShowReplies($reply['id'], $replies_temp, $post_id);
                ?>
            </li>
            <?php
            }
            ?>
            </ul>
        <?php
        }
    }
}