<?php





function getActionMessage ($statusValue = 0) {
    $status = [
        '0' => '',
        '1' => "User and password didn\'t match",
        '2' => "Email doesn't exist",
        '3' => "Email has been already registered",
        '4' => "Congratulations, account created successfully",
    ];
    return $status[$statusValue];
}

