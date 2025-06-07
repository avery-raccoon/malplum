<?php
/**
 * Malplum – Fake PII Data API
 */

// First & last name pools
$first_names = ['Avery','Jordan','Taylor','Morgan','Casey','Riley','Quinn','Sydney','Reese','Dakota'];
$last_names  = ['Smith','Johnson','Lee','Patel','Garcia','Brown','Wilson','Martinez','Davis','Clark'];

// Email domains
$email_domains = ['hotmail.com','gmail.com','yahoo.com','aol.com','protonmail.com','fastmail.net','mailinator.com'];

// Interest pool
$interests = ['reading','gaming','coding','music','sports','traveling','photography','cooking','yoga','gardening','painting','movies','hiking','dancing','knitting','blogging'];

// Street names, cities, provinces
$street_names = ['Oak St.','Maple Ave','Pine Rd','Cedar Blvd','Elm St','Birch Way','Spruce Dr.'];
$cities        = ['Vancouver','Burnaby','Richmond','Surrey','Toronto','Montreal','Ottawa'];
$provinces     = ['BC','ON','QC','AB','MB'];

// User-agent strings
$user_agents = [
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
    'Mozilla/5.0 (X11; Linux x86_64)',
    'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)'
];

// Wishlist items
$wishlist = ['wireless earbuds','Arduino kit','coffee beans','gaming mouse','LED strip lights','yoga mat','graphic novel'];

// Generate full name
$first = $first_names[array_rand($first_names)];
$last  = $last_names[array_rand($last_names)];
$name  = "$first $last";

// Email
$email_user   = strtolower(str_replace(' ', '.', $name)) . rand(100,999);
$email_domain = $email_domains[array_rand($email_domains)];
$email        = "$email_user@$email_domain";

// Phone (N. America)
$phone = sprintf('(%03d) %03d-%04d', rand(200,999), rand(200,999), rand(1000,9999));

// Mailing address
$street_num  = rand(100,9999);
$street_name = $street_names[array_rand($street_names)];
$city        = $cities[array_rand($cities)];
$province    = $provinces[array_rand($provinces)];
$postal_code = sprintf('%s%d%s %d%s%d', chr(rand(65,90)), rand(0,9), chr(rand(65,90)), rand(0,9), chr(rand(65,90)), rand(0,9));
$address     = [
    'street'      => "$street_num $street_name",
    'city'        => $city,
    'province'    => $province,
    'postal_code' => $postal_code,
    'country'     => 'Canada'
];

// Date of birth
$year  = rand(1940,2002);
$month = rand(1,12);
$day   = rand(1,28);
$dob   = sprintf('%04d-%02d-%02d', $year, $month, $day);

// Credit card snippet
$cc_prefixes    = ['4111','5500','3400','3000'];
$cc_last4       = str_pad(rand(0,9999),4,'0',STR_PAD_LEFT);
$cc_snippet     = $cc_prefixes[array_rand($cc_prefixes)] . '-xxxx-xxxx-' . $cc_last4;
$cc_expiry_month = str_pad(rand(1,12),2,'0',STR_PAD_LEFT);
$cc_expiry_year  = rand(date('Y'), date('Y')+5);
$credit_card    = [
    'number'       => $cc_snippet,
    'expiry_month' => $cc_expiry_month,
    'expiry_year'  => $cc_expiry_year
];

// Last login metadata
$login_ip   = sprintf('%d.%d.%d.%d', rand(1,255), rand(0,255), rand(0,255), rand(1,254));
$user_agent = $user_agents[array_rand($user_agents)];
$last_login = [
    'ip'          => $login_ip,
    'user_agent'  => $user_agent,
    'timestamp'   => time() - rand(0,86400*30)
];

// Social handles
$social_handles = [
    'twitter'   => '@' . strtolower($first) . rand(10,99),
    'instagram' => '@' . strtolower($last) . rand(10,99),
    'linkedin'  => strtolower($first) . '.' . strtolower($last)
];

// Random interests & wishlist
shuffle($interests);
$chosen_interests = array_slice($interests, 0, 3);
shuffle($wishlist);
$chosen_wishlist  = array_slice($wishlist, 0, 3);

// Geolocation around Vancouver
$lat      = 49 + (rand(-50,50)/100);
$lng      = -123 + (rand(-50,50)/100);
$location = ['lat' => $lat, 'lng' => $lng];

// Assemble response
$output = [
    'name'           => $name,
    'email'          => $email,
    'phone'          => $phone,
    'address'        => $address,
    'dob'            => $dob,
    'credit_card'    => $credit_card,
    'last_login'     => $last_login,
    'social_handles' => $social_handles,
    'interests'      => array_values($chosen_interests),
    'wishlist'       => array_values($chosen_wishlist),
    'access_level'   => 'limited',
    'auth_token'     => bin2hex(random_bytes(16)),
    'token'          => bin2hex(random_bytes(16)),
    'timestamp'      => time(),
    'location'       => $location
];

// Output JSON
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);
?>
