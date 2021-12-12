<?php require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));

}

$id = $_GET['id'];

$salamander = find_salamander_by_id($id);

if(is_post_request()) {
    $sql = "DELETE FROM salamander ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    //FOR DELETE statements, $result is t/f
    if($result) {
        redirect_to(url_for('/salamanders/index.php'));
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
<?php include(SHARED_PATH . '/salamanderHeader.php'); ?>


<div id="content">

    <a href="<?= url_for('/salamanders/index.php'); ?>">&laquo; Back to List</a>

    <div>
        <h1>Delete Salamander</h1>
        <p>Are you sure you want to delete this salamander entry?</p>
        <p>Name:<?= h($salamander['name']) ?></p>
        <p>ID:<?= h($salamander['id'])?></p>

        <form action="<?= url_for('salamanders/delete.php?id=' . h(u($salamander['id']))) ?>" method ="post">
            <div>
                <input type="submit" name="commit" value="Delete Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/salamanderFooter.php'); ?>
