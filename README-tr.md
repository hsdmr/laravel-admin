# Laravel Admin Panel

## Gereksinimler

Projeyi çalıştırmak için bilgisayarınıza <a href="https://getcomposer.org/">composer</a> kurmalısınız ve aşağıdaki şartları sağlamalısınız

- Laravel >= 8.x
- PHP >= 7.4

## zip dosyasıyla indir

- Yeşil renkli code butonu ile projenin zip dosyasını bilgisayarınıza indirin.
- Dosyayı zip'ten çıkarın.

## git ile indir

Bilgisayarınızda git kurulu değilse bu <a href="https://git-scm.com/downloads">linkden</a> işletim sisteminize uygun olanı kurun.

- Terminal ekranı açarak aşağıdaki aşağıdaki kodu yapıştırın ve çalıştırın.

  ```
  git clone https://github.com/hsdmr/laravel-admin.git
  ```
## Kurulum

- Proje dosyası içindeki .env.example isimli dosyanın ismini .env olarak değiştirin.
- .env dosyasını açarak veritabanı bilgilerinizi kaydedin.
- Terminalden proje dosyasının içine girin ve sırasıyla aşağıdaki kodları yapıştırın.

  ```
  composer install
  php artisan key:generate
  php artisan storage:link
  php artisan migrate:fresh
  php artisan db:seed
  php artisan optimize
  php artisan serve
  ```

- localhost:8000 portundan projeye erişebilirsiniz.

## Hatırlatmalar

Projeyi sunucuya deploy ederken klasör izin hataları olursa aşağıdaki kodları deneyebilirsiniz.

  ```
  chmod -R o+w storage
  chmod 755 -R laravel-admin
  ```

