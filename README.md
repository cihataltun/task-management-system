# Görev Yönetim Sistemi (Task Management System)

**Görev Yönetim Sistemi**, kullanıcıların giriş yaptıktan sonra kendi görevlerini yönetebileceği, diğer kullanıcılara görev atayabileceği, görevleri tamamlayabileceği ve silebileceği Laravel tabanlı bir web uygulamasıdır. Proje hem **web arayüzü** (Blade) hem de **RESTful API** desteği sunar.

## 🎯 Projenin Amacı
Bu proje, Laravel kullanarak veri modelleme, kullanıcı yetkilendirme, görev atama, CRUD işlemleri, API geliştirme ve test yazımı konularında pratik yapmayı hedefler.

## 🚀 Özellikler
- **Kullanıcı Girişi**: Sadece giriş yapmış kullanıcılar görev yönetebilir.
- **Görev Oluşturma**: Başlık, açıklama, durum ve atanacak kullanıcı bilgisi ile yeni görev ekleme.
- **Görev Düzenleme**: Mevcut görev bilgilerini ve atanmış kullanıcıyı güncelleme.
- **Görev Tamamlama**: Tek tıklama ile görevin durumunu “Tamamlandı” olarak değiştirme.
- **Görev Silme**: Kullanıcılar kendi görevlerini silebilir.
- **Görev Atama**: Görevler başka bir kullanıcıya atanabilir ve o kullanıcı kendi görev listesinde görebilir.
- **Kullanıcı-Görev İlişkisi**:
  - Görevi oluşturan kullanıcı
  - Göreve atanan kullanıcı
- **Basit ve Kullanıcı Dostu Arayüz**: Blade ile hazırlanmış görev listeleme ve form sayfaları.
- **REST API**: Tüm görev işlemleri API üzerinden de yapılabilir.
- **Testler**: API uç noktaları PHPUnit testleri ile güvence altına alınmıştır.

## 🛠 Teknik Detaylar
- **Framework**: Laravel
- **Veritabanı**: MySQL
- **Authentication**: Laravel Breeze / Sanctum ile kullanıcı kimlik doğrulama
- **Model İlişkileri**:
  - `User` ➡️ `hasMany(Task, created_by)` → Görevi oluşturan kullanıcı
  - `User` ➡️ `hasMany(Task, assigned_to)` → Göreve atanan kullanıcı
  - `Task` ➡️ `belongsTo(User, created_by)`
  - `Task` ➡️ `belongsTo(User, assigned_to)`
- **Middleware**: Auth kontrolü ile sadece yetkili kullanıcılar görev yönetebilir.
- **Validation**: Görev başlığı, açıklaması ve atanacak kullanıcı zorunlu alanlar olarak doğrulanır.
- **API Uç Noktaları**:
  - `GET /api/tasks` → Kullanıcının oluşturduğu veya kendisine atanmış görevleri listeler
  - `POST /api/tasks` → Yeni görev ekler (atanacak kullanıcı belirtilir)
  - `PUT /api/tasks/{id}` → Görevi ve atama bilgilerini günceller
  - `PATCH /api/tasks/{id}/complete` → Görevi tamamlar
  - `DELETE /api/tasks/{id}` → Görevi siler

## 📷 Örnek Ekran Görüntüleri
- **Görev Listesi Sayfası** – Kullanıcının oluşturduğu ve kendisine atanmış görevleri gösterir.
- **Yeni Görev Ekleme Formu** – Görev atanacak kullanıcı seçme alanı içerir.
- **Görev Düzenleme Formu** – Atanmış kullanıcıyı değiştirebilme özelliği.

## ✅ Sonuç
Bu proje ile Laravel’in **MVC yapısını**, **Eloquent ORM ilişkilerini**, **görev atama mantığını**, **REST API geliştirme** sürecini, **validation** ve **middleware** kullanımlarını uygulamalı olarak deneyimleyebilirsiniz.
Ayrıca test yazımı sayesinde uygulamanın güvenilirliğini artırarak profesyonel bir geliştirme süreci izlenmiştir.
