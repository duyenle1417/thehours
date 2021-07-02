<?php
include("../../path.php");
require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/topics_functions.php');

//check if user's role is ADMIN else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] === 1) {
    ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Thêm danh mục | Admin TheHours</title>
</head>

<body>
<!-- BEGIN HEADER -->
<div class="admin-header">
    <div class="logo">
        <a href="<?php echo BASE_URL . "admin/dashboard.php"; ?>">ADMIN DASHBOARD</a>
    </div>

    <?php include(ROOT_PATH . '/admin/include/menu.php'); ?>
    </div>

<!-- END HEADER -->


<!-- BEGIN SIDEBAR -->
<?php
    include(ROOT_PATH . '/admin/include/sidebar.php'); ?>
<!-- END SIDEBAR -->

<!-- BEGIN ADMIN CONTENT -->
<div class="admin-content">
    <div class="title">
        <p>Thêm danh mục mới</p>
    </div>


    <div class="add-topic-form">
        <form action="" method="post" name="form" enctype="multipart/form-data">
        <?php include(ROOT_PATH . '/include/message.php'); ?>
            <!-- name -->
            <div class="row">
                <div class="col-25">
                    <label for="name">Tên topic:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="name"
                        placeholder="Thời sự...">
                </div>
            </div>

            <!-- parent_topic_id -->
            <div class="row">
                <div class="col-25">
                    <label for="parent_topic_id">Danh mục cha:</label>
                </div>
                <div class="col-75">
                <select name="parent_topic_id" id="parent_topic_id">
                    <option value="#" selected disabled>- Hãy chọn danh mục cha -</option>
                    <option value="NULL">Trống</option>
                    <?php
                        $parent_topics = getParentTopics();
    foreach ($parent_topics as $parent_topic) {  ?>
                            <option value="<?php echo $parent_topic['id'] ?>"><?php echo $parent_topic['name'] ?></option>
                        <?php
                    } ?>
                </select>
                </div>
            </div>

            <!-- Button Submit -->
            <div class="btn-group">
                <input type="submit" value="Add" name="add-topic">
            </div>
        </form>
    </div>
</div>
<!-- END ADMIN CONTENT -->

    
</body>

</html>
<?php
} else {
                        header('location: ' . BASE_URL);
                    }?>