Set WshShell = CreateObject("WScript.Shell")
WshShell.Run "cmd /c C:\laragon\www\MaristanTarbiV2\start_laravel_server.bat", 0, True
Set WshShell = Nothing
