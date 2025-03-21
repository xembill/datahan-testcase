# Datahan Test-Case - Ürün ve Varyant Yönetim Paneli

Bu proje, CodeIgniter 4 kullanılarak hazırlanmış bir ürün yönetim panelidir.  
Amaç; bir giyim firması örneği üzerinden, varyant (örneğin: Beden, Renk) ve çoklu görsel desteği ile ürün ekleme, listeleme ve detay gösterimi yapmaktır.

---

## 🚀 Kullanılan Teknolojiler (Stack)

- PHP 8.3
- CodeIgniter 4.6
- MySQL 8.0
- TailwindCSS v4 (NPM üzerinden build)
- Alpine.js
- Nginx veya Apache
- Ubuntu 22+ / 24+

---

## ⚙️ Kurulum ve Kullanım

1. Repoyu klonla:

```bash
git clone https://github.com/xembill/datahan-testcase.git
cd datahan-testcase
```

2. Bağımlılıkları yükle:

```bash
composer install
npm install
```

3. Tailwind CSS'i build et:

```bash
npm run dev
```

4. Ortam dosyasını ayarla:

```bash
cp env .env
php spark key:generate
```

5. Veritabanı ayarlarını `.env` dosyasına gir:

```dotenv
database.default.hostname = localhost
database.default.database = datahan_db
database.default.username = root
database.default.password = root_password
```

6. Migration çalıştır:

```bash
php spark migrate
```

7. Uygulamayı başlat:

```bash
php spark serve
```

---

## 📁 Görsellerin Çalışması İçin

Görseller `writable/uploads/products/` klasörüne yüklenir.  
Ancak tarayıcıdan erişmek için symlink gerekir:

```bash
cd public
mkdir uploads
ln -s ../writable/uploads/products products
```

Artık görseller şu şekilde açılır:

```
http://localhost:8080/products/filename.jpg
```

---

## 🧩 Özellikler

- Ürün ekleme (isim, fiyat, görseller, varyant seçimi)
- Çoklu görsel yükleme + ana görsel seçimi
- Varyant & alt özellik yönetimi
- Admin panelde CRUD işlemleri
- Kullanıcıya özel ürün listeleme sayfası (kart görünüm)
- Detay sayfasında tüm varyantları gösterme
- Live search (ürün adıyla arama)

---

## 👤 Geliştirici

Test-case geliştirmesi: **Seçkin Kılınç**  
