<?php session_start();
$m_level = $_SESSION['user_group'];
if($m_level!='2'){
    Header("Location: logout.php");
}else{   
    
    require_once('conn.php');

    if(isset($_GET['id_st'])){
        
    //ประกาศตัวแปรรับค่าจาก param method get
    $id = $_GET['id_st'];

    echo $id;

    $stmt = $conn->prepare('DELETE FROM library_storage WHERE id_st=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    //  sweet alert 
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if($stmt->rowCount() ==1){
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "ลบข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "staff_index.php?page=staff/storage"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
        }else{
        echo '<script>
                setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    type: "error"
                }, function() {
                    window.location = "staff_index.php?page=staff/storage"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
            </script>';
        }
    $conn = null;
    } //isset
}
?>
