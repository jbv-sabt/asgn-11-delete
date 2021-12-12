<?php require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/public/salamanders/index.php'));

}

$id = $_GET['id'];

$subject = find_salamander_by_id($id);

if(is_post_request()) {
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    //FOR DELETE statemetns, $result is t/f
    if($result) {
        redirect_to(url_for('/public/salamanders/index.php'));
    }
    else
    {
        //Delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/salamanderHeader'); ?>

<div id="content">

    <a class ="back-link" href=<?php echo url_for('/index.php'); ?>">&laquo; Back to list</a>

    <div class="salamander delete">
        <h1>Delete Salamander</h1>
        <p>Are you sure you want to delete this salamander entry?</p>
        <p><?= h($salamander['name']); ?></p>

        <form action="<?= url_for('/salamanders/subjects.php?id=' . h(u($salamander['id']))); ?>" method ="post">
            <div>
                <input type="submit" name="commit" value="Delete Subject" />
            </div>
        </form>
    </div>
</div>

<?php inlcude(SHARED_PATH . '/private/salamanderFooter.php'); ?>
