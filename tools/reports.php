<link rel='stylesheet' href='style.css' type='text/css'>
<?php $connection=mysqli_connect( "localhost", "root", "mason.wolf", "inventory"); 

$num_rec_per_page=10; 

if(isset($_GET[ 'page'])) { 
    $page=$_GET[ 'page'];
     } else { $page=1 ; } 
     
$start_from=( $page-1) * $num_rec_per_page; 
$sql="SELECT * FROM reports ORDER BY id DESC LIMIT $start_from, $num_rec_per_page" ; 
$result=mysqli_query($connection, $sql); ?>

<table id="tools">
    <tr>
        <th style='text-align:center;'>Assignee</th>
        <th style='text-align:center;'>Kit #</th>
        <th style='text-align:center;'>Report</th>
    </tr>
    <?php while ($row=mysqli_fetch_assoc($result)) { 
      
   ?>
    <td>
        <p style="style= text-overflow : ellipsis;
        white-space   : nowrap;
        width         : -50px;
        overflow      : hidden;">
            <center>
                <a href="..\tools\Profile.php?technician=<?php echo $row['LastName']; ?>">
                    <?php echo $row[ 'User']; ?> </a>
            </center>
        </p>
    </td>
    <td style='text-align:center;'>
        <?php echo $row[ 'AssignedKit']; ?>
    </td>
    <td style='text-align:center;'>
        <?php echo "<a href='Tool_Report.php?Report=" . $row['ID'] . "'>View</a>"; ?> </td>
    </tr>


    <?php } ?>
</table>
</br>
<a href="../tools/Reports_FullView.php" style="margin-left:145px;">View All</a>