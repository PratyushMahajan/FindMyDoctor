<?php

$search_param = $_POST['search'];
$search_area = $_POST['area'];

if(isset($_POST["search"]) && isset($_POST["area"])){
        
// Connection to database
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "doctor_website";


$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

$sql = "SELECT * FROM `doctors` WHERE DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql); 

$data = "";
$doctor_data = "";

if($result->num_rows > 0){
    
    $data = '<div class="space-y-4 text-2xl font-bold mb-4">Top doctors found in your area</div>';
    
    
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorarea = $row["DoctorArea"];
        $doctorimage = $row["DoctorImage"];
        
        $doctor_data = $doctor_data.'<div class="space-y-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex items-center">
                <img class="h-24 w-24 rounded-full" src="'.$doctorimage.'" alt="DoctorImage">
                <div class="ml-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">'.$doctorname.'</h3>
                    <p class="text-sm text-gray-500">'.$doctorinfo.'</p>
                    <p class="text-sm text-gray-500">'.$doctorarea.'</p>
                </div>
            </div>
        </div>
        </div>';
    }
    
}
else{
    $data = '<div class="space-y-4 text-2xl font-bold mb-4">No Doctor found in your area</div>';
}

$data = $data.$doctor_data;
echo $data;

}

?>
