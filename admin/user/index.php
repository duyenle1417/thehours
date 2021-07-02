<?php
include("../../path.php");
require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/users_functions.php');
//check if user's role is ADMIN else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] === 1) {
    $users = GetAllUsers(); ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Quản lý User | Admin TheHours</title>
    
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
    
    <!-- Admin Page Wrapper -->
    <div class="admin-wrap">

        <?php include(ROOT_PATH . '/admin/include/sidebar.php'); ?>


        <!-- Admin Content -->
        <div class="admin-content">

            <h2 class="page-title">User's dashboard</h2>
            

            <div class="btn"><a href="add.php" class="add-btn">Add</a></div>

            <div class="content">
                <div class="user-table">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>

                        

                        <tbody>
                            <?php
                        
    $STT = 1;
    foreach ($users as $user) {?>

                            <tr>
                                <td><?php echo $STT; ?></td>
                                <td>
                                    <span style="font-weight: 500;"><?php echo $user['username']; ?></span>
                                </td>
                                <td class="Email">
                                    <?php echo '<span style="color: #2B54C1;">'. $user['email'] .'</span>'; ?>
                                </td>
                                <td class="fullname">
                                    <?php echo  $user['fullname'] ; ?>
                                </td>
                                <td class="role">
                                    <?php $role = getRoleById($user['role_id']); echo $role['role'] ?>
                                </td>
                                <td class="thaotac">
                                    <div class="btn-group">
                                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="edit-btn">Edit</a>
                                        <a href="index.php?delete_id=<?php echo $user['id']; ?>"
                                            class="delete-btn">Delete</a>
                                    </div>
                                </td>

                            </tr>
                            <?php
                        $STT++;
                        }; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- // Admin Content -->
    </div>
<!-- // Page Wrapper -->
    <div class="admin">
        hello
    </div>
</body>
</html>
<?php
} else {
                            header('location: ' . BASE_URL);
                        }?>