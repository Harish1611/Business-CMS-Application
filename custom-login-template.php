<?php
/**
 * Template Name: Custom Login Template
 */

// Check if the user is logged in
if (is_user_logged_in()) {
    // User is logged in, redirect to home page
    wp_redirect(home_url('/home')); // Redirect to the home page
    exit();
} else {
    // User is not logged in, display the login form
    get_header(); // Include your header file if needed
    wp_redirect(home_url('/login'));
    // Display Ultimate Member login form
    get_footer(); // Include your footer file if needed
}
?>