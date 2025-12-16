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
        $newContent = $content
        
        if ($newContent -notmatch "@use '\.\./base/variables' as \*") {
            $newContent = "@use '../base/variables' as *;`n" + $newContent
        }
        
        if ($newContent -notmatch "@use '\.\./base/mixins' as \*") {
            $newContent = "@use '../base/mixins' as *;`n" + $newContent
        }
        
        if ($newContent -ne $content) {
            $utf8NoBom = New-Object System.Text.UTF8Encoding $false
            [System.IO.File]::WriteAllText($path, $newContent, $utf8NoBom)
            Write-Host "Updated imports in $file"
        } else {
            Write-Host "Imports already exist in $file"
        }
    } else {
        Write-Host "File not found: $file"
    }
}