#!/usr/bin/perl

use strict;
use warnings;

use CGI;
my $cgi = CGI->new;

# Get form data
my $first_name = $cgi->param('first_name');
my $last_name = $cgi->param('last_name');
my $street = $cgi->param('street');
my $city = $cgi->param('city');
my $postal_code = uc($cgi->param('postal_code'));  # Convert to uppercase
my $province = $cgi->param('province');
my $phone = $cgi->param('phone');
my $email = $cgi->param('email');
my $photo = $cgi->param('photo');

# Check for input correctness using regular expressions
my $errors = '';

unless ($phone =~ /^\d{10}$/) {
    $errors .= "Phone number must be 10 digits.<br>";
}

unless ($postal_code =~ /^[A-Z]\d[A-Z] \d[A-Z]\d$/) {
    $errors .= "Postal code must be in the format L0L 0L0.<br>";
}

unless ($email =~ /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/) {
    $errors .= "Invalid email address.<br>";
}

# Display submitted information
print $cgi->header;
print "<html><head><title>Registration Result</title></head><body>";

if ($errors) {
    print "<h1>Error:</h1><p>$errors</p>";
} else {
    print "<h1>Registration Successful</h1>";
    print "<p>Name: $first_name $last_name</p>";
    print "<p>Address: $street, $city, $province, $postal_code</p>";
    print "<p>Phone: $phone</p>";
    print "<p>Email: $email</p>";
    print "<p>Photograph: $photo</p>";
    print "<img src='../upload/$photo'>"
}

print "</body></html>";

