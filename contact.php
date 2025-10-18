<?php
$filename = 'submissions.txt';

// Always present in both forms
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$from_email = filter_input(INPUT_POST, 'from_email', FILTER_SANITIZE_EMAIL);

// Fields from index.html
$from_phone = filter_input(INPUT_POST, 'from_phone', FILTER_SANITIZE_STRING);
$additional_info = filter_input(INPUT_POST, 'additional-infoinquires-38', FILTER_SANITIZE_STRING);

// Fields from intake-form.html
$surface_type = isset($_POST['What type of surface are you interested in?']) ? implode(', ', $_POST['What type of surface are you interested in?']) : 'N/A';
$size = filter_input(INPUT_POST, 'What is the approximate size of the area for installation (in square feet)?-1', FILTER_SANITIZE_STRING);
$timeline = filter_input(INPUT_POST, 'What is your desired timeline for the project?-1', FILTER_SANITIZE_STRING);
$budget = filter_input(INPUT_POST, 'What is your budget range for this project?-1', FILTER_SANITIZE_STRING);
$services = isset($_POST['Which service or services are you interested in?']) ? implode(', ', $_POST['Which service or services are you interested in?']) : 'N/A';
$color = filter_input(INPUT_POST, 'Do you have a specific color or pattern in mind?-1', FILTER_SANITIZE_STRING);
$details = filter_input(INPUT_POST, 'Please provide any additional details or special requests.-1', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
$consultation = isset($_POST['Would you like to schedule an in-person consultation?-1']) ? 'Yes' : 'No';

// Prepare data for file
$data = "=== New Submission ===\n";
$data .= "Name: $name\nEmail: $from_email\n";

// Add index.html fields if present
if ($from_phone) $data .= "Phone: $from_phone\n";
if ($additional_info) $data .= "Additional Info: $additional_info\n";

// Add intake-form.html fields if present
if ($surface_type !== 'N/A') $data .= "Surface Type: $surface_type\n";
if ($size) $data .= "Size: $size\n";
if ($timeline) $data .= "Timeline: $timeline\n";
if ($budget) $data .= "Budget: $budget\n";
if ($services !== 'N/A') $data .= "Services: $services\n";
if ($color) $data .= "Color: $color\n";
if ($details) $data .= "Details: $details\n";
if ($message) $data .= "Message: $message\n";
$data .= "Consultation: $consultation\n\n";

// Append to file
file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);

// Redirect or confirm
header('Location: thank-you.html');
exit;
?>
