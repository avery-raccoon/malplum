<<?php
/**
 * Malplum – Fake PII Data API (v1) with Fault Injection
 */

// Random error injection (1% chance of HTTP 500)
if (rand(1,100) <= 1) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Internal server error']);
    exit;
}

// Data pools
$first_names   = ['Avery','Jordan','Taylor','Morgan','Casey','Riley','Quinn','Sydney','Reese','Dakota'];
$last_names    = ['Smith','Johnson','Lee','Patel','Garcia','Brown','Wilson','Martinez','Davis','Clark'];
$email_domains = ['hotmail.com','gmail.com','yahoo.com','aol.com','protonmail.com','fastmail.net','mailinator.com'];
$interests     = ['reading','gaming','coding','music','sports','traveling','photography','cooking','yoga','gardening','painting','movies','hiking','dancing','knitting','blogging'];
$street_names  = ['Oak St.','Maple Ave','Pine Rd','Cedar Blvd','Elm St','Birch Way','Spruce Dr.'];
$cities        = ['Vancouver','Burnaby','Richmond','Surrey','Toronto','Montreal','Ottawa'];
$provinces     = ['BC','ON','QC','AB','MB'];
$user_agents   = [
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
    'Mozilla/5.0 (X11; Linux x86_64)',
    'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)'
];
$wishlist      = ['wireless earbuds','Arduino kit','coffee beans','gaming mouse','LED strip lights','yoga mat','graphic novel'];

// Premium metadata
$companies   = ['Acme Corp','Globex','Soylent','Initech','Umbrella Corp','Hooli','Aperture Science'];
$job_titles  = ['Software Engineer','Product Manager','Data Scientist','UX Designer','System Administrator'];
$premium_rate = 10; // 10%

function generate_record() {
    global $first_names,$last_names,$email_domains,$interests,
           $street_names,$cities,$provinces,$user_agents,$wishlist,
           $companies,$job_titles,$premium_rate;

    $first = $first_names[array_rand($first_names)];
    $last  = $last_names[array_rand($last_names)];
    $name  = "$first $last";

    // Email
    $user       = strtolower(str_replace(' ','',$name)) . rand(100,999);
    $domain     = $email_domains[array_rand($email_domains)];
    $email      = "$user@$domain";

    // Phone
    $phone      = sprintf('(%03d) %03d-%04d',rand(200,999),rand(200,999),rand(1000,9999));

    // Address
    $street     = rand(100,9999) . ' ' . $street_names[array_rand($street_names)];
    $city       = $cities[array_rand($cities)];
    $province   = $provinces[array_rand($provinces)];
    $postal     = sprintf('%s%d%s %d%s%d',chr(rand(65,90)),rand(0,9),chr(rand(65,90)),rand(0,9),chr(rand(65,90)),rand(0,9));
    $address    = ['street'=>$street,'city'=>$city,'province'=>$province,'postal_code'=>$postal,'country'=>'Canada'];

    // DOB
    $dob        = sprintf('%04d-%02d-%02d',rand(1940,2002),rand(1,12),rand(1,28));

    // CC snippet
    $prefix     = ['4111','5500','3400','3000'][array_rand([0,1,2,3])];
    $cc         = $prefix . '-xxxx-xxxx-' . str_pad(rand(0,9999),4,'0',STR_PAD_LEFT);
    $exp_m      = str_pad(rand(1,12),2,'0',STR_PAD_LEFT);
    $exp_y      = rand(date('Y'),date('Y')+5);
    $credit_card= ['number'=>$cc,'expiry_month'=>$exp_m,'expiry_year'=>$exp_y];

    // Last login
    $ip         = sprintf('%d.%d.%d.%d',rand(1,255),rand(0,255),rand(0,255),rand(1,254));
    $ua         = $user_agents[array_rand($user_agents)];
    $last_login = ['ip'=>$ip,'user_agent'=>$ua,'timestamp'=>time()-rand(0,86400*30)];

    // Social
    $social     = ['twitter'=>'@'.strtolower($first).rand(10,99),'instagram'=>'@'.strtolower($last).rand(10,99),'linkedin'=>strtolower($first).'.'.strtolower($last)];

    // Interests & wishlist
    shuffle($interests);  $ints = array_slice($interests,0,3);
    shuffle($wishlist);   $wl   = array_slice($wishlist,0,3);

    // Geo
    $lat        = 49 + (rand(-50,50)/100);
    $lng        = -123 + (rand(-50,50)/100);
    $location   = ['lat'=>$lat,'lng'=>$lng];

    $rec = [
        'name'=>$name,'email'=>$email,'phone'=>$phone,'address'=>$address,
        'dob'=>$dob,'credit_card'=>$credit_card,'last_login'=>$last_login,
        'social_handles'=>$social,'interests'=>$ints,'wishlist'=>$wl,
        'access_level'=>'limited','token'=>bin2hex(random_bytes(16)),
        'timestamp'=>time(),'location'=>$location
    ];

    // Premium tier?
    if (rand(1,100) <= $premium_rate) {
        $rec['company']   = $companies[array_rand($companies)];
        $rec['job_title'] = $job_titles[array_rand($job_titles)];
        $rec['tier']      = 'premium';
    }

    return $rec;
}

// Bulk-fetch logic
$count = isset($_GET['count']) ? intval($_GET['count']) : null;
if (!$count || $count < 1) {
    $count = rand(1,20);
} else {
    $count = min($count,100);
}

// Output
if ($count > 20) {
    header('Content-Type: application/x-ndjson');
    for ($i = 0; $i < $count; $i++) {
        echo json_encode(generate_record()) . "
";
    }
} else {
    $data = [];
    for ($i = 0; $i < $count; $i++) {
        $data[] = generate_record();
    }
    header('Content-Type: application/json');
    echo json_encode(['data'=>$data,'count'=>count($data)], JSON_PRETTY_PRINT);
}
?>
