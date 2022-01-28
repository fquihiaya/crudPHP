<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php require_once 'process.php'; ?>

    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php  
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>


<div class="container">
<?php   
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
?> 

<div class="d-flex justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>name</th>
                <th>location</th>
                <th colspan="2">action</th>
            </tr>
        </thead>
        <?php
            while($row = $result->fetch_assoc()): ?>
            <tr> 
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['location'];?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>"
                    class="btn btn-danger"> delete </a>
                </td>
            </tr>
            <?php endwhile;?>
    </table>
</div>     
    <div class="d-flex justify-content-center">
        <form action="process.php " method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label >Name</label>
                <input type="text" name="name" class="form-control" 
                value="<?php echo $name ?>" placeholder="entrer votre nom">
            </div>
            <div class="form-group">
                <label >Location</label>
                <input type="text" name="location" class="form-control" 
                value="<?php echo $location ?>" placeholder="entrer votre location" >
            </div>
            <div class="form-group">
                <?php
                    if($update == true):
                ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php
                    else:
                ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php
                    endif;
                ?>
            </div>
        </form>
    </div>
</div> 
</body>
</html>