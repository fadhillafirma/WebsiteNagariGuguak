
$files = Get-ChildItem -Path "c:\webnagariGuguk (2)\webnagariGuguk\resources\views" -Recurse -Filter "*.blade.php"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    
    $pattern = '(?s)<div class="foot-h">Kontak</div>\s*<ul class="foot-ul">.*?</ul>\s*</div>'
    $replacement = '<div class="foot-h">Kontak</div>
                <ul class="foot-ul">
                    <li><a href="#">Jl. Raya Guguak No.01, Kec. Sijunjung</a></li>
                    <li><a href="mailto:info@nagariguguaksijunjung.id">info@nagariguguaksijunjung.id</a></li>
                    <li><a href="tel:0751123456">(0751) 123456</a></li>
                </ul>
            </div>'
            
    if ($content -match $pattern) {
        $content = $content -replace $pattern, $replacement
        Set-Content -Path $file.FullName -Value $content -Encoding UTF8
        Write-Host "Modified $($file.FullName)"
    }
}

