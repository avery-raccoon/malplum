<?php
header('Content-Type: application/json');

// --- Fake data pools ---
$usernames = ['sunnydog', 'glimmerfox', 'tinyhero', 'spiderfriend', 'weirdunit', 'fluffomatic'];
$domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'protonmail.com', 'live.com'];

$first_names = ['Alex', 'Jamie', 'Morgan', 'Taylor', 'Riley', 'Jordan', 'Casey'];
$last_names = ['Rivera', 'Patel', 'Nguyen', 'Smith', 'Khan', 'Garcia', 'O’Neil'];

$cities = ['Toronto', 'Portland', 'Berlin', 'Osaka', 'Cape Town', 'Reykjavik', 'Sydney'];
$countries = ['Canada', 'USA', 'UK', 'Japan', 'Germany', 'Australia'];

$statuses = ['active', 'pending', 'suspended'];
$sources = ['referral', 'popup_ad', 'newsletter', 'affiliate_link', 'qr_code'];
$interests = ['vegan_baking', 'crypto', 'knitting', 'parkour', 'karaoke', 'doom_modding'];

function random_subset($array, $max = 3) {
    shuffle($array);
    return array_slice($array, 0, rand(1, min($max, count($array))));
}

// --- Random generators ---
$fake_user = $usernames[array_rand($usernames)] . rand(100, 999);
$fake_domain = $domains[array_rand($domains)];
$fake_email = "$fake_user@$fake_domain";

$full_name = $first_names[array_rand($first_names)] . ' ' . $last_names[array_rand($last_names)];
$location = $cities[array_rand($cities)] . ', ' . $countries[array_rand($countries)];

// --- Construct base JSON ---
$data = [
    "user" => $fake_email,
    "access_level" => "limited",
    "token" => bin2hex(random_bytes(16)),
    "timestamp" => time(),
];

// --- Optional bullshit fields ---
$extra = [
    "full_name" => $full_name,
    "location" => $location,
    "email_verified" => (bool)rand(0, 1),
    "account_status" => $statuses[array_rand($statuses)],
    "signup_source" => $sources[array_rand($sources)],
    "interests" => random_subset($interests),
];

// Mix and randomly inject fields (2 to 4 extras)
$keys = array_keys($extra);
shuffle($keys);
foreach (array_slice($keys, 0, rand(2, 4)) as $key) {
    $data[$key] = $extra[$key];
}

// --- Emit the JSON ---
echo json_encode($data, JSON_PRETTY_PRINT);
?>
