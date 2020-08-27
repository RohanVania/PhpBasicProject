<?php
require_once("./classes/dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></linK>

    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</head>

<body>

<!--  Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
            <div class="form-group">
                <label for="titleedit">Title </label>
                <input type="text" class="form-control" id="titleedit" name="titleedit" required>
            </div>
            <div class="form-group">
                <label for="descriptionedit">Description </label>
                <textarea class="form-control" name="descriptionedit" rows="5" id="descriptionedit"></textarea>
            </div>
            <input type="hidden" class="form-control" id="idedit" name="idedit" >
            <button type="submit" name="updatenote" class="btn btn-success">Update</button>
        </form>
      </div>
     
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Notes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Delete Note -->

<?php
    if(isset($_GET['delete'])){
     $id= $_GET['delete'];
     $sql="delete from notes where id=$id";
     $delete=mysqli_query($connect,$sql);
    
?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <strong>Note !</strong> deleted successfully !!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php
header("refresh:3;url=index.php");
    }
  
?>

    <!-- Update Note -->

    <?php
    
if(isset($_POST['updatenote'])){
  $updateid= $_POST['idedit'];
  $updatetitle=$_POST['titleedit'];
  $updatedescription=$_POST['descriptionedit'];
  $sql="UPDATE notes set title='$updatetitle',description='$updatedescription' where id=$updateid";
  $update=mysqli_query($connect,$sql);
  ?>
  
 <div class='alert alert-primary alert-dismissible fade show' role='alert'>
        <strong>Note !</strong> Updated successfully !!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
<?php
header("refresh:3;url=index.php");
}
    ?>

 <!-- Add Note -->

<?php
if(isset($_POST['addnote'])){
 
$title=$_POST['title'];
$description=$_POST['description'];
$sql="Insert into notes(title,description) Values ('$title','$description')";
$insert=mysqli_query($connect,$sql);
?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Note !</strong> added successfully !!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php 
}
?>

    <div class=" container  my-3 py-4  ">
        <form action="" method="post">
            <h4>Add Notes to INote </h4>
            <div class="form-group">
                <label for="titlenote">Title </label>
                <input type="text" class="form-control" id="titlenote" name="title" required>
            </div>
            <div class="form-group">
                <label for="descriptionnote">Description </label>
                <textarea class="form-control" name="description" rows="5" id="descriptionnote"></textarea>
            </div>
            <button type="submit" name="addnote" class="btn btn-success">Add Note</button>
        </form>

    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>DESCRIPTION</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql="select * from notes";
                  $query=mysqli_query($connect,$sql);
                  $i=0;
                  while($row=mysqli_fetch_assoc($query)){
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['description'];?></td>
                    <td>  <button type="btn" class=" edit btn btn-primary" id="<?php echo  $row['id']?>">Edit</button>   <button type="btn" class=" delete btn btn-danger" id="<?php echo  $row['id']?>">Delete</button></td>
                </tr>

            </tbody>
            <?php
}
        ?>
        </table>

    </div>

</body>
<script>
edits=document.getElementsByClassName("edit");
Array.from(edits).forEach((element)=>{
  element.addEventListener("click",(e)=>{
    console.log("edit",);
    tr=e.target.parentNode.parentNode;
    title=tr.getElementsByTagName("td")[1].innerText;
    description=tr.getElementsByTagName("td")[2].innerText;
    console.log(title,description);
    titleedit.value=title;
    descriptionedit.value=description;
    idedit.value=e.target.id;
    console.log(e.target.id);
    $('#editModal').modal('toggle')
  })
})

deletes=document.getElementsByClassName("delete");
Array.from(deletes).forEach((element)=>{
  element.addEventListener("click",(e)=>{
    console.log("delete",e.target);
   if( confirm("Are you sure you want to Delete the Record !!")){
    window.location=`index.php?delete=${e.target.id}`;
   }
   else{
    console.log("no");
   }
  })
});


</script>
</html>

