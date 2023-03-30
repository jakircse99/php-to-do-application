<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
    }
session_start();
require_once (dirname(__FILE__).'/../config/config.php');
$conn = mysqli_connect(HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if(!$conn) {
    throw New Exception("Database connection not established");
}

// sanitize and validate note form
$action = $_POST['action'] ?? 0;
$noteName = '';
$noteErr = '';
$userId = $_SESSION['id'] ?? 0;

if('add-note' == $action) {
    if(empty($_POST['note'])) {
        $noteErr = "Note name is missing";
    }else {
        if(strlen($_POST['note'])> 50) {
            $noteErr = "Note name should be less then 50 latters";
        }else {
            $noteName = validateInput($_POST['note']);
        }
    }
}

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($noteName && $userId) {
    $query = "INSERT INTO notes (user_id, note) VALUES('{$userId}', '{$noteName}') ";
    if(mysqli_query($conn, $query)) {
        header('location: keep-notes.php?status=added');
    }
}

// display notes

function displayNotes($userId) {
    global $conn;
    $query = "SELECT * FROM notes WHERE user_id = '{$userId}'";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result)> 0) {
        while($_data = mysqli_fetch_assoc($result)){
            array_push($data, $_data);
        }
    }
    return $data;
}

// delete notes
 
if('delete' == $action) {
    $noteIds = $_POST['note-ids'];
    $_noteIds = join(',', $noteIds);
    if($noteIds) {
        $query = "DELETE FROM notes WHERE id in ($_noteIds)";
        mysqli_query($conn, $query);
        header('location:keep-notes.php?status=deleted');
    }
}