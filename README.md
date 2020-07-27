# ÖĞRENCİ VE PERSONEL TAŞIMACILIK OTOMASYONU
## Bu uygulama kapsamında;
* Öğrenci ve Personel ’in adresi, okulu(iş yeri) ve kişisel bilgilerin kaydı tutulacak.
* Personel ve öğrencilerin ilgili araçlara listesine eklenecek.
* Araç listesine eklenen personel ve öğrencilerin koordinatları belirlenecek.
* Belirlenen koordinatlara göre rota oluşturulacak.
* Rota hesabı manuel ve otomatik olarak iki yöntem ile yapılacak.
* Manuel rota hesabında;
* Koordinatları belirlenen noktalar harita üzerinde işaretlenecek.
* Kullanıcı(admin) tarafından işaretlenen noktalar sürükle bırak yöntemi ile rota oluşturulacak.
* Otomatik rota hesabında;(Bu kısım uygulanabilirliğe göre düzenlenecek)
* Gezgin satıcı algoritmalarından proje uygun olanı seçilip uygun rota oluşturulması sağlanacak.
* Personel ve öğrenci aidat takip bölümü oluşturulacak.
* Şirket çalışanlarına ait ödemeler için takip bölümü oluşturulacak.
* Şirket muhasebe işleri bölümü oluşturulacak. Bu kısımda Harcanan Yakıt, Personel Gideri, Araç Bakımı ve Kurum resmi giderleri vb. kayıt altına alınacak.
* Aylık ve yıllık mizan çalışması yapılacak.

## Sisteme Girişi Sayfası / login.php
![image](https://user-images.githubusercontent.com/65366156/88530839-a41f8180-d00a-11ea-8e97-617fb67c8be7.png)

## AnaSayfa / index.php
Sisteme Kayıtlı Tüm Öğrenci/Personel, Okul/İşyeri, Şoför ve Araç Sayılarını Görüntüleyebilirsiniz.
Tüm Güzergâhları Görüntüleyip / Silebilirsiniz.

![image](https://user-images.githubusercontent.com/65366156/88531002-dcbf5b00-d00a-11ea-8100-ab6d7f0adc92.png)

## Öğrenci-Personel Kayıt Formu / ogrenci-personel-kayit.php
Sisteme yeni Öğrenci/Personel ekleyebilirsiniz. 
Form gerekli alanlar doldurulduktan sonra koordinat bul ile adresin doğruluğu kontrol edilip sisteme yeni kayıt olarak eklenmesi sağlanır. 

![image](https://user-images.githubusercontent.com/65366156/88531111-06788200-d00b-11ea-99e5-7cd61f8f9ef5.png)

Koordinat Bul işlemi sonrası adresi doğru koordinatta ise kayıt işlemi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531150-1001ea00-d00b-11ea-9378-b96c2ed39ba3.png)

Kaydet işlemi sonrası kayıt başarı durumu görüntülenir ve yeni kayıt için form oluşturulur.

![image](https://user-images.githubusercontent.com/65366156/88531191-214af680-d00b-11ea-859c-0161175c1bd4.png)

## Okul-İşyeri Kayıt Formu / okul-is-kayit.php
Sisteme yeni Okul-İşyeri ekleyebilirsiniz. 
Form gerekli alanlar doldurulduktan sonra koordinat bul ile adresin doğruluğu kontrol edilip sisteme yeni kayıt olarak eklenmesi sağlanır. 

![image](https://user-images.githubusercontent.com/65366156/88531220-2d36b880-d00b-11ea-9c6e-fb1b45233e5d.png)

Koordinat Bul işlemi sonrası adresi doğru koordinatta ise kayıt işlemi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531256-39bb1100-d00b-11ea-89b2-12a8de71e38d.png)

Kaydet işlemi sonrası kayıt başarı durumu görüntülenir ve yeni kayıt için form oluşturulur.

![image](https://user-images.githubusercontent.com/65366156/88531280-42abe280-d00b-11ea-83e7-8c7225a8d133.png)

## Şoför Kayıt Formu / sofor-kayit.php
Sisteme yeni Şoför ekleyebilirsiniz. 
Formda gerekli alanlar doldurularak kayıt işlemi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531302-4e97a480-d00b-11ea-824a-cedbccfe5999.png)

## Araç Kayıt Formu / arac-kayit.php
Sisteme yeni Araç ekleyebilirsiniz. 
Formda gerekli alanlar doldurularak kayıt işlemi yapılır. 

![image](https://user-images.githubusercontent.com/65366156/88531336-5c4d2a00-d00b-11ea-97f0-b119856bae2c.png)

## Güzergah Oluşturma Formu / guzergah-adres-sec.php
Güzergâh oluşturmak için okul-işyeri adresi seçimi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531362-6707bf00-d00b-11ea-916d-a2cab47cff72.png)

İşyeri-okul güzergâh hazırlanması için personel-öğrenci sıra seçimi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531384-725aea80-d00b-11ea-852c-dfebe7b263e5.png)

Güzergâh için şoför araç seçimi yapılarak toplam güzergâh süresi ve uzunluğu hesaplanır.

![image](https://user-images.githubusercontent.com/65366156/88531422-7dae1600-d00b-11ea-8f41-f82ef1393ea1.png)

## Güzergah  Kayıtlar Sayfası / guzergahlar-tablo.php
Oluşturulan güzergâhların silinmesi- görüntülenmesi yapılır.

![image](https://user-images.githubusercontent.com/65366156/88531447-8a326e80-d00b-11ea-9ce7-6de35f5898c3.png)


İşyeri-Okul ve Şoföre ait Personel-öğrenci Görüntülenme Listesi.

![image](https://user-images.githubusercontent.com/65366156/88531484-97e7f400-d00b-11ea-888f-40c76db0e18b.png)

## Öğrenci – Personel Kayıtlar / ogrenci-personel-tablo.php
Öğrenci-Personel Kayıtlarının Görüntülenip Silinmesi

![image](https://user-images.githubusercontent.com/65366156/88531520-a6361000-d00b-11ea-92cb-c30038e3839c.png)

## Okul - İşyeri Kayıtlar / okul-is-tablo.php
Okul-İşyeri Kayıtlarının Görüntülenip Silinmesi

![image](https://user-images.githubusercontent.com/65366156/88531553-b221d200-d00b-11ea-94f2-d485d889d1e7.png)

## Araç Kayıtlar / arac-tablo.php
Araç Kayıtlarının Görüntülenip Silinmesi

![image](https://user-images.githubusercontent.com/65366156/88531581-ba7a0d00-d00b-11ea-9bde-3d8bf4181700.png)

## Şoför Kayıtlar / sofor-tablo.php
Şoför Kayıtlarının Görüntülenip Silinmesi

![image](https://user-images.githubusercontent.com/65366156/88531619-c960bf80-d00b-11ea-9ad7-cf3f721a88df.png)

