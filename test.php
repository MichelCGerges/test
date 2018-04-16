 <?php
 $userName = filter_input(INPUT_POST, "userName");
 $repoName = filter_input(INPUT_POST, "repoName");
 $token = filter_input(INPUT_POST, "token");
 $name = filter_input(INPUT_POST, "name");

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.github.com/repos/". $userName ."/". $repoName ."/hooks?access_token=". $token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",  
        CURLOPT_POSTFIELDS => " { \"name\": ". $name . ",\n  \"active\": true,\n  \"events\": [\n    \"push\",\n    \"pull_request\"\n  ],\n  \"config\": {\n    \"url\": \"http://example.com/webhook\",\n    \"content_type\": \"json\"\n  }\n }",
        CURLOPT_HTTPHEADER => array(
            "User-Agent: user"
        ),asd
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $userInfo = json_decode($response);
    }
?>