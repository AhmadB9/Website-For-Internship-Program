<?php
function get_allprogram($con){
    $data=array();
    $sql = "SELECT * FROM program order by enddate";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[]=$row;
  }
  return $data;}
}
function get_startdate($con,$id){
    $sql = "SELECT startdate FROM program where id= '$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $start_date=$row["startdate"];
   }
   return $start_date;
  }
function get_availableprogram($con){
    $data=array();
    $today = date("Y-m-d");
    $sql = "SELECT * FROM program where startregistration <='$today' and endregistration >='$today' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data[]=$row;
  }
  return $data;}
}
function get_status($startdate,$endate,$id){
    $today = date("Y-m-d");
    if($today > $endate)
        return '<td>
        <span class="text-red-500">End</span>
    </td>
    <td><a href="" style="color:blue">---</a></td>
    ';
    else if($today >= $startdate && $today<=$endate){
        return'<td>
        <span class="text-green-500">In progress</span>
    </td>
    <td><a href="addprogram.php?id='.$id.'" style="color:blue">Edit</a></td>';
    }
    else if($today <= $startdate && $today<=$endate){
        return '<td>
        <span class="text-green-500">Soon</span>
    </td>
    <td><a href="addprogram.php?id='.$id.'" style="color:blue">Edit</a></td>
    ';
    }
}
function get_programnb($con){
    $sql = "SELECT COUNT(*) as count FROM program";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["count"];
    }
}
function get_internnb($con){
    $sql = "SELECT COUNT(*) as count FROM intern";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["count"];
    }
}
function get_instructornb($con){
    $sql = "SELECT COUNT(*) as count FROM instructor";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["count"];
    }
}
function get_allinterns($con){
    $data=array();
    $sql = "SELECT * FROM intern order by fullname";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row;
      }
      return $data;
    }
}
function get_allinstructors($con){
    $data=array();
    $sql = "SELECT * FROM instructor order by fullname";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row;
      }
      return $data;
    }
}
function get_instructorsprogram($con,$id){
    $data=array();
    $sql = "SELECT program.title from instructor 
    JOIN program ON instructor.id = program.instructorid
    where  instructor.id='$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
          $data[$i]=$row["title"];
          $i++;
      }
      return $data;
    }
}
function get_instructorname($con,$id){
    $data=array();
    $sql = "SELECT fullname from instructor Where id='$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row["fullname"];
    }
}
function get_instructorid($con,$name){
    $sql="SELECT * from instructor WHERE fullname='$name'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        return $row["id"];
    }
}
function get_progrom_details($con,$id){
    $sql = "SELECT * FROM program where id= '$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}
function get_internprogram($con,$id){
    $data=array();
    $sql = "SELECT * from intern
    INNER JOIN internsinprogram ON intern.id = internsinprogram.internid
    INNER JOIN program ON program.id = internsinprogram.programid
    where  intern.id='$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row;
          
      }
      return $data;
    }
}
function is_user_inprogram($con,$id,$internid){
    $sql="SELECT * from internsinprogram WHERE programid='$id' and internid='$internid'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else return false;
}
function get_instructorprograms($con,$id){
    $data=array();
    $sql = "SELECT * from instructor 
    JOIN program ON instructor.id = program.instructorid
    where  instructor.id='$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row; 
        }
        return $data;
    }
}
function get_interninprogram($con,$id){
    $data=array();
    $sql = "SELECT * from intern
    INNER JOIN internsinprogram ON intern.id = internsinprogram.internid
    INNER JOIN program ON program.id = internsinprogram.programid
    where  program.id='$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row;
        }
      return $data;
    }
}
function get_distinguishedinterns($con){
    $data=array();
    $sql = "SELECT * from intern
    INNER JOIN internsinprogram ON intern.id = internsinprogram.internid
    INNER JOIN program ON program.id = internsinprogram.programid
    where  grade >= 90 order by grade DESC";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $data[]=$row;
        }
      return $data;
    }
}

?>