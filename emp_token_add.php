<?php
include('connections.php');
include('header.php');
error_reporting(0);
if($_SESSION["username"]=="admin")
{
    header("Location: http://localhost/testpro/admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<center>
        <h1>Employee Token</h1>
    </center>
    
    <?php
    $emp_id=$_GET['id'];
    ?>
    <form action="" method="POST">
    Employee ID<input type="number" name="empid" hidden value="<?php echo $emp_id; ?>" id="" ><br>
    Doctor ID<select name="docid" id=""><br>
            <option value="" selected disabled>Select Doctor</option>
            <?php
            $select_sql="select * from doctor";
            $result_select=mysqli_query($conn,$select_sql);
            while($select_data=mysqli_fetch_assoc($result_select))
            {?>
                <option value="<?php echo $select_data['DOCID'] ?>"><?php echo $select_data['DOCID'] ?></option>
            <?php }
            ?>
        </select>
        <input type="submit" name="submit" value="Submit">
        <?php
         $doc_id=$_POST['docid'];
        if(isset($_POST['submit'])  && $doc_id!="Select Doctor" ){
        $sql="insert into token(EMPID,DOCID) values('{$emp_id}','{$doc_id}')";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            header("Location: http://localhost/testpro/receptionist_dashboard.php");
        }
        else{
            echo "Query failed :'(";
        }
    }else{ echo "Select Doctor please!"; }
        ?>
        
    </form>
</body>
</html>