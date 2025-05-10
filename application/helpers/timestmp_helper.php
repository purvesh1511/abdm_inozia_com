<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function timestampUid(){
    $timestamp = time();  // Unix timestamp (seconds)
      $microseconds = microtime(true) - $timestamp;
      $utc_date = gmdate('Y-m-d\TH:i:s', $timestamp);
      $milliseconds = round($microseconds * 1000);  // Convert to milliseconds
      $timestamp =  $utc_date . '.' . sprintf('%03d', $milliseconds) . 'Z';
    
      $uuid = bin2hex(random_bytes(16));
       $tuuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);

   $data = array(
              "timestamp"=>$timestamp,
              "uuid"=>$tuuid
               );

    return $data;


}