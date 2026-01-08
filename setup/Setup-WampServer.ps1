# ============================================================================
# Maristan SaaS Setup Script for WampServer
# سكريبت إعداد مشروع Maristan على WampServer
# ============================================================================
# يجب تشغيل هذا السكريبت كـ Administrator
# ============================================================================

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "   Maristan SaaS - WampServer Setup" -ForegroundColor Cyan  
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Check if running as Administrator
$currentPrincipal = New-Object Security.Principal.WindowsPrincipal([Security.Principal.WindowsIdentity]::GetCurrent())
if (-not $currentPrincipal.IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)) {
    Write-Host "[ERROR] يجب تشغيل هذا السكريبت كـ Administrator!" -ForegroundColor Red
    Write-Host "اضغط بزر الفأرة الأيمن واختر 'Run as Administrator'" -ForegroundColor Yellow
    Read-Host "اضغط Enter للخروج"
    exit 1
}

$projectPath = "C:\Users\OA\Desktop\isat mosstafa\MartistanTarbiV2"
$hostsFile = "C:\Windows\System32\drivers\etc\hosts"

# Step 1: Update Windows hosts file
Write-Host "[1/4] تحديث ملف hosts..." -ForegroundColor Yellow

$hostsEntries = @"

# ============================================
# Maristan SaaS - Added by setup script
# ============================================
127.0.0.1       maristan.local
127.0.0.1       khalid.maristan.local
127.0.0.1       ouknik.maristan.local
127.0.0.1       ista.maristan.local
127.0.0.1       test.maristan.local
127.0.0.1       test-clinic-full.maristan.local
127.0.0.1       clinic-final-test.maristan.local
127.0.0.1       demo.maristan.local
# ============================================
"@

# Check if entries already exist
$hostsContent = Get-Content $hostsFile -Raw
if ($hostsContent -notmatch "maristan.local") {
    Add-Content -Path $hostsFile -Value $hostsEntries
    Write-Host "   [OK] تم إضافة الـ domains إلى ملف hosts" -ForegroundColor Green
} else {
    Write-Host "   [SKIP] الـ domains موجودة مسبقاً في ملف hosts" -ForegroundColor Gray
}

# Step 2: Find WampServer Apache path
Write-Host "[2/4] البحث عن مسار Apache في WampServer..." -ForegroundColor Yellow

$wampPaths = @(
    "E:\wamp64\bin\apache",
    "C:\wamp64\bin\apache",
    "C:\wamp\bin\apache"
)

$apachePath = $null
foreach ($path in $wampPaths) {
    if (Test-Path $path) {
        $apacheVersions = Get-ChildItem $path -Directory | Sort-Object Name -Descending
        if ($apacheVersions.Count -gt 0) {
            $apachePath = $apacheVersions[0].FullName
            break
        }
    }
}

if ($apachePath) {
    Write-Host "   [OK] تم العثور على Apache: $apachePath" -ForegroundColor Green
    
    # Step 3: Update Virtual Hosts
    Write-Host "[3/4] تحديث Virtual Hosts..." -ForegroundColor Yellow
    
    $vhostFile = "$apachePath\conf\extra\httpd-vhosts.conf"
    $vhostConfig = @"

# ============================================
# Maristan SaaS Virtual Hosts
# Added by setup script
# ============================================

# Central Domain (SuperAdmin)
<VirtualHost *:80>
    ServerName maristan.local
    DocumentRoot "$projectPath/public"
    
    <Directory "$projectPath/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

# Tenant Subdomains (Clinics)
<VirtualHost *:80>
    ServerName wildcard.maristan.local
    ServerAlias *.maristan.local
    DocumentRoot "$projectPath/public"
    
    <Directory "$projectPath/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

# ============================================
"@
    
    $vhostContent = Get-Content $vhostFile -Raw -ErrorAction SilentlyContinue
    if ($vhostContent -notmatch "maristan.local") {
        Add-Content -Path $vhostFile -Value $vhostConfig
        Write-Host "   [OK] تم إضافة Virtual Hosts" -ForegroundColor Green
    } else {
        Write-Host "   [SKIP] Virtual Hosts موجودة مسبقاً" -ForegroundColor Gray
    }
} else {
    Write-Host "   [WARNING] لم يتم العثور على WampServer Apache" -ForegroundColor Yellow
    Write-Host "   يجب إعداد Virtual Hosts يدوياً" -ForegroundColor Yellow
}

# Step 4: Clear Laravel cache
Write-Host "[4/4] مسح cache Laravel..." -ForegroundColor Yellow
Set-Location $projectPath

php artisan config:clear 2>$null
php artisan cache:clear 2>$null
php artisan route:clear 2>$null
php artisan view:clear 2>$null

Write-Host "   [OK] تم مسح الـ cache" -ForegroundColor Green

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "   تم الإعداد بنجاح!" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "الخطوات التالية:" -ForegroundColor Yellow
Write-Host "1. أعد تشغيل WampServer" -ForegroundColor White
Write-Host "2. افتح SuperAdmin: http://maristan.local/superadmin/login" -ForegroundColor White
Write-Host "3. افتح عيادة khalid: http://khalid.maristan.local/login" -ForegroundColor White
Write-Host ""
Write-Host "بيانات الدخول:" -ForegroundColor Yellow
Write-Host "- SuperAdmin: admin@maristan.ma / password" -ForegroundColor White
Write-Host "- Admin عيادة khalid: khalid@gmail.com / 1234567890" -ForegroundColor White
Write-Host ""

Read-Host "اضغط Enter للخروج"
