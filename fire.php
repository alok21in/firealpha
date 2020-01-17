<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__.'/vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
//include 'send_push.php';

/*$storage = new StorageClient([
    'keyFile' => json_decode(file_get_contents(__DIR__.'/alpha5-b78f6-firebase-adminsdk-qm29x-71d7f41ee3.json'), true)
]);*/

$storage = new StorageClient([
    'keyFilePath' => __DIR__.'/alpha5-b78f6-firebase-adminsdk-qm29x-71d7f41ee3.json'
]);

$firestore = new FirestoreClient(['projectId' => 'alpha5-b78f6']);

$collectionReference = $firestore->collection('Users');
//$docRef = $db->collection('cities')->document('SF');
$snapshot = $collectionReference->documents();

foreach ($snapshot as  $one_snapshot) {
    print_r($one_snapshot['email']);echo "<br>";exit;
}

print_r($snapshot);exit;

if(isset($oneuser))
{
 
$logKey = $database->getReference('logs')->push()->getKey();
foreach($oneuser as $one_fav_user)
{
    


   $fav_user=$database->getReference('users/'.$one_fav_user.'/details')
    ->orderByKey()
    //->equalTo($one_fav_user)
    ->getSnapshot()
    ->getValue();

//print_r($fav_user);exit;

if(isset($fav_user['pushToken']))
{
    $id=$fav_user['pushToken'];




$user_id=$fav_user['uid'];
$deviceType=$fav_user['deviceType'];



if($senderAuthID!=$user_id) 
{



if($deviceType=="android")
{


//send push on android
sendpush($message,$id,$data);

}
else{

// send push on Ios
//print_r($id);exit;
applepush($id,$payload);



}


//now save in db for activity check


$time=time();
$microtime1=microtime();
$database->getReference()->update(['logs/'.$logKey.'/PostKey'=>$commentID,'logs/'.$logKey.'/time'=>$time,'logs/'.$logKey.'/senderAuthID'=>$senderAuthID,'logs/'.$logKey.'/LoopRun'=>$aa,'logs/'.$logKey.'/microtime'=>$microtime1]);



// Create a key for a new post
$newPostKey = $database->getReference('users')->push()->getKey();


$updates = [
    'users/'.$user_id.'/notifications/'.$newPostKey.'/commentID' => $commentID,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/commentType' => $commentType,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/isNew' => true,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/message' => $message,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/recieverAuthID' => $user_id,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/senderAuthID' => $senderAuthID,
    'users/'.$user_id.'/notifications/'.$newPostKey.'/type' => $type,
];

$database->getReference() // this is the root reference
   ->update($updates);


}






}






}
//exit;
}





echo json_encode(array('status'=>200,'message'=>"Success"),JSON_PRETTY_PRINT);

?>