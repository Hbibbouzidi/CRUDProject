<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
        <?php require_once 'connect.php'; ?>
        <?php if(isset($_SESSION['message'])):?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
            <?php endif ?>
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'stock') or die(mysql_error($mysqli));
        $result = $mysqli->query("select * from Article") or die($mysqli->error);
        ?>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <tr>
                    <td colspan="4"><h1>ARTICLES IN STOCK</h1></td>
                    <td><a class="btn" href="connect.php?add">Add New</a></td>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>Designation</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td> <?php echo $row["id"]; ?> </td>
                    <td> <?php echo $row["designation"]; ?> </td>
                    <td> <?php echo $row["price"]; ?> </td>
                    <td> <?php echo $row["quantity"]; ?> </td>
                    <td>
                        <a class="btn btn-info" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                        <a class="btn btn-danger" href="connect.php?delete=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
            while($row = $result->fetch_assoc())
        ?>

        <div class="row justify-content-center">
        <form action="index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Designation :</label>
            <input class="form-control" type="text" name="designation" 
                    value="<?php echo $designation ?>" placeholder="Article Designation">
            </div>
            <div class="form-group">
            <label>Price :</label>
            <input class="form-control" type="number" name="price" 
                    value="<?php echo $price ?>" placeholder="0.00">
            </div>
            <div class="form-group">
            <label>Quantity :</label>
            <input class="form-control" type="number" name="quantity" 
                    value="<?php echo $quantity ?>" placeholder="0">
            </div>
            <div class="form-group">
                <?php if($update == true): ?>
                <input class="btn btn-info" type="submit" name="update" value="Update">
                <?php else: ?>
                <input class="btn btn-primary" type="submit" name="save" value="Save">
                <?php endif; ?>
            </div>
        </form>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    </body>
</html>