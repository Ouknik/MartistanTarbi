# 🏥 Maristan SaaS - دليل الإعداد على WampServer

## 📋 المتطلبات
- WampServer (PHP 8.0+, MySQL 8.0+, Apache)
- Composer
- Node.js & npm

---

## ⚠️ ملاحظة مهمة حول Subdomains

عند إنشاء **عيادة جديدة** من لوحة SuperAdmin، يجب إضافة الـ subdomain يدوياً في ملف hosts:

```
127.0.0.1       newclinic.maristan.local
```

**أو** يمكنك استخدام **Acrylic DNS Proxy** لدعم wildcard subdomains تلقائياً (انظر القسم في الأسفل).

---

## 🚀 خطوات الإعداد السريع

### الطريقة 1: الإعداد التلقائي (موصى به)

1. **افتح PowerShell كـ Administrator**
2. **انتقل لمجلد المشروع:**
   ```powershell
   cd "C:\Users\OA\Desktop\isat mosstafa\MartistanTarbiV2"
   ```
3. **شغل سكريبت الإعداد:**
   ```powershell
   .\setup\Setup-WampServer.ps1
   ```

---

### الطريقة 2: الإعداد اليدوي

#### 1️⃣ تعديل ملف hosts
افتح الملف التالي **كـ Administrator**:
```
C:\Windows\System32\drivers\etc\hosts
```

أضف هذه الأسطر:
```
# Maristan SaaS
127.0.0.1       maristan.local
127.0.0.1       khalid.maristan.local
127.0.0.1       ouknik.maristan.local
127.0.0.1       ista.maristan.local
127.0.0.1       test.maristan.local
```

#### 2️⃣ إعداد Virtual Hosts في Apache
افتح الملف:
```
C:\wamp64\bin\apache\apache2.4.x\conf\extra\httpd-vhosts.conf
```

أضف:
```apache
# Maristan SaaS - Central Domain
<VirtualHost *:80>
    ServerName maristan.local
    DocumentRoot "C:/Users/OA/Desktop/isat mosstafa/MartistanTarbiV2/public"
    
    <Directory "C:/Users/OA/Desktop/isat mosstafa/MartistanTarbiV2/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

# Maristan SaaS - Tenant Subdomains
<VirtualHost *:80>
    ServerName wildcard.maristan.local
    ServerAlias *.maristan.local
    DocumentRoot "C:/Users/OA/Desktop/isat mosstafa/MartistanTarbiV2/public"
    
    <Directory "C:/Users/OA/Desktop/isat mosstafa/MartistanTarbiV2/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### 3️⃣ أعد تشغيل WampServer
- اضغط على أيقونة WampServer
- اختر "Restart All Services"

---

## 🔗 روابط الدخول

| النوع | الرابط | البريد | كلمة المرور |
|-------|--------|--------|-------------|
| **SuperAdmin** | http://maristan.local/superadmin/login | admin@maristan.ma | password |
| **عيادة khalid** | http://khalid.maristan.local/login | khalid@gmail.com | 1234567890 |
| **عيادة ouknik** | http://ouknik.maristan.local/login | - | - |
| **عيادة ista** | http://ista.maristan.local/login | - | - |

---

## 📊 بنية المشروع

```
http://maristan.local/
├── /superadmin/login     → تسجيل دخول SuperAdmin
├── /superadmin/          → لوحة تحكم SuperAdmin
├── /superadmin/tenants   → إدارة العيادات
└── /superadmin/plans     → إدارة الخطط

http://{clinic}.maristan.local/
├── /login               → تسجيل دخول العيادة
├── /patients            → إدارة المرضى
├── /consultations       → الاستشارات
└── /...                 → باقي الخدمات
```

---

## 🗄️ قواعد البيانات

| قاعدة البيانات | الاستخدام |
|----------------|-----------|
| `maristan` | القاعدة المركزية (SuperAdmin, Tenants, Plans) |
| `maristan_khalid` | بيانات عيادة khalid |
| `maristan_ouknik` | بيانات عيادة ouknik |
| `maristan_ista` | بيانات عيادة ista |

---

## 🛠️ أوامر مفيدة

```bash
# مسح الـ cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# بناء الـ frontend
npm run build

# تشغيل الـ dev server
npm run dev

# التحقق من الإعداد
php check_setup.php
```

---

## ❓ حل المشاكل الشائعة

### المشكلة: الصفحة فارغة بعد تسجيل الدخول
```bash
npm run build
php artisan config:clear
```

### المشكلة: خطأ 404 على الـ subdomain
1. تأكد من إضافة الـ domain في ملف hosts
2. تأكد من إعداد Virtual Hosts
3. أعد تشغيل WampServer

### المشكلة: Redirect Loop
```bash
php artisan cache:clear
# امسح cookies المتصفح
```

---

## 📞 الدعم

إذا واجهت أي مشكلة، تأكد من:
1. ✅ WampServer يعمل (الأيقونة خضراء)
2. ✅ ملف hosts يحتوي على الـ domains
3. ✅ Virtual Hosts مُعدّة بشكل صحيح
4. ✅ قواعد البيانات موجودة

---

📅 آخر تحديث: 2026-01-07
