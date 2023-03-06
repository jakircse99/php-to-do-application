<?php





function getActionMessage ($statusValue = 0) {
    $status = [
        '0' => '',
        '1' => "User and password didn\'t match",
        '2' => "Username doesn\'t exist",
        '3' => "This email address is already exist",
        '4' => "Congratulations, account created successfully"
    ];
    return $status[$statusValue];
}

