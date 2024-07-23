<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GitHub Profil Görüntüleme</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="style.css?version=newcsslast" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Banner -->
    <header class="bg-blue-600 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">GitHub Profil Görüntüleyici</h1>
    </header>

    <main class="flex-grow flex items-center justify-center">
        <div class="container mx-auto p-6 bg-white rounded shadow-lg">
            <form id="profile-form" class="mb-4">
                <input type="text" name="username" required placeholder="GitHub Kullanıcı Adı" class="border p-2 rounded w-full">
                <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded w-full">Profil Bilgilerini Göster</button>
            </form>

            <div id="loading-message" class="hidden text-center text-blue-500 mb-4">Profil GitHub'dan çekiliyor...</div>

            <div id="profile-info" class="hidden">
                <div class="text-center">
                    <img id="avatar" src="" alt="" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h2 id="name" class="text-xl font-semibold"></h2>
                    <p id="login" class="text-gray-600"></p>
                    <p id="bio" class="text-gray-800"></p>
                    <a id="profile-link" href="" target="_blank" class="text-blue-500 mt-4 inline-block">GitHub Profiline Git</a>
                </div>

                <div id="readme-content" class="mt-6 hidden">
                    <h3 class="text-lg font-semibold mb-2">README.md İçeriği:</h3>
                    <div class="bg-gray-100 p-4 rounded markdown-content"></div>
                </div>
            </div>

            <p id="error-message" class="text-red-500 text-center hidden"></p>
        </div>
    </main>


    <footer class="bg-blue-600 text-white p-4 text-center">
        <p>&copy; <?php echo date('Y'); ?> GitHub Profil Görüntüleyici. Tüm hakları saklıdır.</p>
    </footer>

    <script>
    $(document).ready(function() {
      // Kullanıcı profil bilgilerini AJAX ile çekmek için bu fonksiyonu kullanıyoruz
      function fetchProfile(username) {
          // Yükleme mesajını göster, profil ve hata mesajlarını gizle
          $('#loading-message').removeClass('hidden');
          $('#profile-info').addClass('hidden');
          $('#error-message').addClass('hidden');

          // AJAX isteğini başlatıyoruz
          $.ajax({
              url: 'ajax.php', // İsteğin yapılacağı dosya
              type: 'GET', // İstek türü
              data: { username: username }, // Gönderilecek veri
              dataType: 'json', // Beklenen veri türü
              success: function(response) {
                  // İstek başarılı olduğunda çalışacak kod
                  $('#loading-message').addClass('hidden'); // Yükleme mesajını gizle

                  if (response.status === 'success') {
                      // Profil bilgilerini güncelle
                      $('#profile-info').removeClass('hidden');
                      $('#avatar').attr('src', response.data.avatar_url);
                      $('#name').text(response.data.name);
                      $('#login').text('@' + response.data.login);
                      $('#bio').text(response.data.bio);
                      $('#profile-link').attr('href', response.data.html_url);

                      // README içeriğini güncelle
                      if (response.readme) {
                          $('#readme-content .markdown-content').html(response.readme);
                          $('#readme-content').removeClass('hidden');
                      } else {
                          $('#readme-content').addClass('hidden');
                      }
                  } else {
                      // Hata mesajını göster
                      $('#error-message').text(response.message).removeClass('hidden');
                  }
              },
              error: function() {
                  // İstek sırasında hata oluşursa çalışacak kod
                  $('#loading-message').addClass('hidden'); // Yükleme mesajını gizle
                  $('#error-message').text('Bir hata oluştu. Lütfen tekrar deneyin.').removeClass('hidden');
              }
          });
      }

      // URL'den kullanıcı adını al ve profili getir
      const urlParams = new URLSearchParams(window.location.search);
      const username = urlParams.get('username');
      if (username) {
          $('input[name="username"]').val(username);
          fetchProfile(username);
      }

      // Form gönderildiğinde profili güncelle
      $('#profile-form').on('submit', function(e) {
          e.preventDefault(); // Formun varsayılan gönderimini engelle
          const username = $('input[name="username"]').val(); // Kullanıcı adını al
          fetchProfile(username); // Yeni profil bilgilerini getir

          // URL'yi güncelle
          const newUrl = new URL(window.location.href);
          newUrl.searchParams.set('username', username);
          window.history.replaceState({}, '', newUrl); // replaceState kullanarak URL'yi güncelle
      });
  });

  </script>

</body>
</html>
