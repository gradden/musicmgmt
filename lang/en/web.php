<?php

return [
    'home' => 'Home',
    'logout' => 'Log out',
    'profile' => auth()->user()->last_name ?? 'Profile',
    'concerts' => 'Concerts',
    'clubs' => 'Clubs',
    'login' => 'Login',
    'action_buttons' => 'Action',
    'search' => 'Search...',
    'edit_details' => 'Edit',
    'email_verify_ok' => 'Your email address has been verified!',
    'resend_email_ok' => 'Email verification link has benn sent!',

    'previous' => 'Previous',
    'next' => 'Next',

    'concert_table_column_titles' => [
        'event_name' => 'Event',
        'club_name' => 'Location',
        'event_date' => 'Date',
        'set_time' => 'Set time',
        'links' => 'Links',
        'status' => 'Status',
        'show' => 'Action',
    ],

    'concert_modal_titles' => [
        'event_name' => 'Event name',
        'location' => 'Location',
        'added_by_user' => 'Created',
        'description' => 'Description',
        'event_start_date' => 'Start date of event',
        'event_end_date' => 'End date of event',
        'income' => 'Income',
        'social_links' => 'Social links',
        'logged' => 'Event created in system',
    ],

    'profile_page' => [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'roles' => 'Roles',
        'password' => 'Password',
        'password_confirm' => 'Confirm password',
        'verified_email' => 'This email address has been verified!',
        'not_verified_email' => 'You must to verify your email address!',
        'update' => 'Update',
        'update_successful' => 'Your profile has been updated successfully!',
        'update_fail' => 'An error has occurred during your profile update. Please try again, later!',
        'select_language' => 'Set language',
        'password_does_not_match' => 'The password does not match. Please try again!',
    ]
];