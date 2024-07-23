
# GitHub Profil Görüntüleyici

GitHub Profil Görüntüleyici, GitHub kullanıcılarının profil bilgilerini ve README.md dosyalarını kolayca görüntülemenizi sağlayan bir web uygulamasıdır. Kullanıcı adı girerek GitHub profil bilgilerini ve varsa README.md içeriğini alabilirsiniz.

## Proje İçeriği

### Dosyalar

- **index.php**: Ana HTML ve JavaScript dosyası. Kullanıcı arayüzü ve profil bilgilerini AJAX ile günceller.
- **ajax.php**: GitHub API'sine yapılan istekleri yöneten PHP dosyası. Kullanıcı bilgilerini ve README.md içeriğini alır.
- **style.css**: Özel CSS dosyası (isteğe bağlı).

### Gereksinimler

- PHP 7.0 veya üstü
- cURL (PHP'nin cURL desteği etkin olmalıdır)
- [Parsedown](https://github.com/erusev/parsedown) kütüphanesi (Markdown'dan HTML'ye dönüştürmek için)

### Kurulum

1. **Depoyu Klonlayın**

   ```bash
   git clone  https://github.com/abdullah-eksi/github_profile_viewer
   ```

2. **Gerekli Kütüphaneleri Yükleyin**

   Parsedown kütüphanesini yüklemek için Composer kullanın:

   ```bash
   composer require erusev/parsedown
   ```

3. **GitHub Erişim Belirteci (Token) Ayarlayın**

   `ajax.php` dosyasında `$access_token` değişkenini, GitHub'dan almış olduğunuz kişisel erişim belirteci ile doldurun. (Bu adım, GitHub API erişiminizi doğrulamak için gereklidir.)

   ```php
   $access_token = 'YOUR_GITHUB_ACCESS_TOKEN';
   ```

4. **Web Sunucusunu Başlatın**

   Projeyi bir web sunucusunda çalıştırın (örneğin, XAMPP, WAMP, veya yerel bir PHP sunucusu).

### Kullanım

1. **Ana Sayfayı Açın**

   Web tarayıcınızda `index.php` dosyasını açın.

2. **Kullanıcı Adını Girin**

   GitHub kullanıcı adını girin ve "Profil Bilgilerini Göster" düğmesine tıklayın.

3. **Profil Bilgilerini Görüntüleyin**

   Kullanıcı bilgileri ve README.md içeriği ekranda gösterilecektir.

### Fonksiyonlar

- **Profil Bilgileri**: Kullanıcının GitHub profil fotoğrafı, adı, kullanıcı adı ve biyografisi.
- **README.md İçeriği**: Kullanıcının GitHub profilindeki README.md dosyasının Markdown içeriği, HTML'e dönüştürülmüş şekilde.


### Lisans

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır.

