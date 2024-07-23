<?php
require 'vendor/autoload.php';

$Parsedown = new Parsedown();

if (isset($_GET['username'])) {
    $username = htmlspecialchars($_GET['username']);

    // Erişim belirteci (GitHub'dan alınmış bir kişisel erişim belirteci)
    $access_token = '';

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => [
                "User-Agent: my-app",
                "Authorization: token $access_token"
            ]
        ]
    ];
    $context = stream_context_create($opts);

    // Kullanıcı bilgilerini çekme
    $url = "https://api.github.com/users/$username";
    $response = file_get_contents($url, false, $context);
    $data = json_decode($response, true);

    if (isset($data['login'])) {
        // Profile README.md dosyasını çekme
        $readme_url = "https://api.github.com/repos/$username/$username/contents/README.md";
        $response_readme = file_get_contents($readme_url, false, $context);
        $readme_data = json_decode($response_readme, true);

        if (isset($readme_data['content'])) {
            $readme_content = base64_decode($readme_data['content']);
            // Markdown içeriğini HTML'e dönüştür
            $readme_html = $Parsedown->text($readme_content);
        } else {
            $readme_html = ''; // README.md bulunamadı
        }

        echo json_encode([
            'status' => 'success',
            'data' => $data,
            'readme' => $readme_html
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Kullanıcı bulunamadı.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Kullanıcı adı sağlanmadı.']);
}
?>
