$path = "d:\xampp\htdocs\advanced\frontend\war-memorial-frontend\styles\pages\_home.scss"
$content = Get-Content $path -Raw
$content = $content -replace '-gold', "map-get(`$primary-colors, 'golden-victory')"
Set-Content $path $content
Write-Host "Replaced -gold in $path"