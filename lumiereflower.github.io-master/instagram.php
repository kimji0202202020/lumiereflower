<?php
$post = array (
  'fields' => 'id,media_type,media_url,permalink,thumbnail_url,username,caption', ➊
  'access_token' => 'IGQVJVeXctN2drYzhPdHNhcmsyNWVUSFpMSkZADdjAxNVBadkgtVU1IeXJnX3VzSWhaY0ZAZANDc4UmhyQmFLR3U5QW9TN0JDVFNsNjByamdNWHJCUlpudGtpRGVVSnY3OVdaSGFoNlp2MWNWOHZA2N1Y4WGxFSV9oelBLdDZA3'
);
$url = "https://graph.instagram.com/17841402195510143/media?".http_build_query($post); ➌
try {
  $curl_connection = curl_init($url);
  curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
  curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($curl_connection);
  curl_close($curl_connection);
} catch(Exception $e) {
  return $e->getMessage();
}

$data = json_decode($result, true);
$image_array= array();

foreach ($data['data'] as $key => $row) {
  $code = $row['id'];  $username = $row['username'];
  $type = $row['media_type'];
  $link = $row['permalink'];
  $thum = ($type === 'VIDEO') ? $row['thumbnail_url'] : $row['media_url'];
  $text = $row['caption'];
  array_push($image_array, array('username'=>$username, 'link'=>$link, 'thum'=>$thum, 'text'=>$text));
}

echo json_encode($image_array);
?>