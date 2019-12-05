<?php
include('inc/pdo.php');
include('inc/function.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM movies_full WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetch();
    if(!empty($)) {
        $sql = "UPDATE movies_full
      SET vote = vote + 1
      WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id',$id,PDO::PARAM_INT);

        $query->execute();

    }else {
        die('404');
    }

}else {
    die('404');
}

header('Location: index.php');
exit;
?>


<form method="post" action="vote.php?id=<?php echo $_GET['id']; ?>">
<input type="radio" name="vote" value="1"> 1
<input type="radio" name="vote" value="2"> 2
<input type="radio" name="vote" value="3"> 3
<input type="radio" name="vote" value="4"> 4
<input type="radio" name="vote" value="5"> 5
<input type="submit" value="voter">
</form>