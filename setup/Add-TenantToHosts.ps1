# =============================================================================
# Add-TenantToHosts.ps1 - إضافة عيادة جديدة لملف hosts
# =============================================================================
# يجب تشغيل هذا السكريبت كـ Administrator بعد إنشاء عيادة جديدة من SuperAdmin
# =============================================================================

param(
    [Parameter(Mandatory=$true)]
    [string]$Subdomain
)

$hostsPath = "C:\Windows\System32\drivers\etc\hosts"
$entry = "127.0.0.1       $Subdomain.maristan.local"

# التحقق من صلاحيات Administrator
$currentPrincipal = New-Object Security.Principal.WindowsPrincipal([Security.Principal.WindowsIdentity]::GetCurrent())
$isAdmin = $currentPrincipal.IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "⚠️  يجب تشغيل هذا السكريبت كـ Administrator!" -ForegroundColor Red
    Write-Host ""
    Write-Host "افتح PowerShell كـ Administrator ثم شغل:" -ForegroundColor Yellow
    Write-Host "  .\setup\Add-TenantToHosts.ps1 -Subdomain $Subdomain" -ForegroundColor Cyan
    exit 1
}

# التحقق من أن الإدخال غير موجود مسبقاً
$hostsContent = Get-Content $hostsPath -Raw
if ($hostsContent -match [regex]::Escape("$Subdomain.maristan.local")) {
    Write-Host "✅ الـ subdomain '$Subdomain.maristan.local' موجود مسبقاً في ملف hosts" -ForegroundColor Green
    exit 0
}

# إضافة الإدخال الجديد
try {
    Add-Content -Path $hostsPath -Value "`n$entry" -Encoding ASCII
    Write-Host "✅ تم إضافة '$Subdomain.maristan.local' بنجاح!" -ForegroundColor Green
    Write-Host ""
    Write-Host "يمكنك الآن الوصول للعيادة على:" -ForegroundColor Cyan
    Write-Host "  http://$Subdomain.maristan.local:9010" -ForegroundColor Yellow
} catch {
    Write-Host "❌ فشل في إضافة الإدخال: $_" -ForegroundColor Red
    exit 1
}
