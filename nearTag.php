<?php header("Content-Type: application/xml; charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "zhengyuxiao12345";
$database = "Mi_Tag_db";
function distance($lon1, $lat1, $lon2, $lat2){
        return (2*ATAN2(SQRT(SIN(($lat1-$lat2)*PI()/180/2)
        *SIN(($lat1-$lat2)*PI()/180/2)+
        COS($lat2*PI()/180)*COS($lat1*PI()/180)
        *SIN(($lon1-$lon2)*PI()/180/2)
        *SIN(($lon1-$lon2)*PI()/180/2)),
        SQRT(1-SIN(($lat1-$lat2)*PI()/180/2)
        *SIN(($lat1-$lat2)*PI()/180/2)
        +COS($lat2*PI()/180)*COS($lat1*PI()/180)
        *SIN(($lon1-$lon2)*PI()/180/2)
        *SIN(($lon1-$lon2)*PI()/180/2))))*6378140;
}
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_query($conn,'set names utf8');
$tag_gps_lat = $POST["Tag_gps_lat"];
$tag_gps_lon = $POST["Tag_gps_lon"];
$sql = "select * from tags";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $dist = distance($tag_gps_lon, $tag_gps_lat, $row["tags_gps_lon"], $row["tags_gps_lat"]);
        if ($dist < 10000){
            echo json_encode($row);
            echo ',';
        }
    }
}
$conn->close();
?>
