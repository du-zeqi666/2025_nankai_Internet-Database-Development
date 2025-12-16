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
        if ($content -notmatch "@use '\.\./base/variables' as \*") {
            $newContent = "@use '../base/variables' as *;`n" + $content
            Set-Content $path $newContent
            Write-Host "Added import to $file"
        } else {
            Write-Host "Import already exists in $file"
        }
    } else {
        Write-Host "File not found: $file"
    }
}