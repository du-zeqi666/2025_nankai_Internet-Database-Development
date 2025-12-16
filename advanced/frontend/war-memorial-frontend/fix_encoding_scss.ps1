$files = @(
    "styles\pages\_site-detail.scss",
    "styles\pages\_relic-detail.scss",
    "styles\pages\_hero-detail.scss",
    "styles\pages\_guestbook.scss",
    "styles\pages\_battle-detail.scss",
    "styles\pages\_article-detail.scss"
)

foreach ($file in $files) {
    $path = "d:\xampp\htdocs\advanced\frontend\war-memorial-frontend\$file"
    if (Test-Path $path) {
        $content = Get-Content $path -Raw
        $utf8NoBom = New-Object System.Text.UTF8Encoding $false
        [System.IO.File]::WriteAllText($path, $content, $utf8NoBom)
        Write-Host "Fixed encoding for $file"
    }
}