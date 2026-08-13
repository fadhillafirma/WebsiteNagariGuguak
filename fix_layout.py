import os

base_dir = r'c:\webnagariGuguk (2)\webnagariGuguk\resources\views\admin'

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.blade.php'):
            path = os.path.join(root, file)
            with open(path, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Change main wrapper padding
            content = content.replace('px-4 py-10', 'px-4 py-6 md:py-10')
            
            # Change header flex wrapper to wrap on small screens
            content = content.replace('class="flex items-center justify-between mb-6"', 'class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6"')
            
            # Change form container padding
            content = content.replace('p-6 rounded-lg shadow', 'p-4 md:p-6 rounded-lg shadow')
            
            # We can also make table text a bit tighter on mobile if needed, but horizontal scrolling is standard.
            # Add whitespace-nowrap to tables to prevent weird wrapping on mobile.
            content = content.replace('class="w-full text-sm text-left text-gray-500"', 'class="w-full text-sm text-left text-gray-500 whitespace-nowrap"')
            
            with open(path, 'w', encoding='utf-8') as f:
                f.write(content)

print('Updated admin views layout padding and wrapping.')
