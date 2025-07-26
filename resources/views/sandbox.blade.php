<!-- resources/views/builder.blade.php -->
<!DOCTYPE html>
<html>
<head>
  <script src="https://editor.unlayer.com/embed.js"></script>
</head>
<body>
  <div id="editor" style="height: 100vh; width: 100vw;"></div>

  <script>
    unlayer.init({
      id: 'editor',
      projectId: 1234, // Optional
    });

    // Untuk mendapatkan hasil HTML
    function saveDesign() {
      unlayer.exportHtml(function(data) {
        var html = data.html;
        // Kirim ke backend pakai AJAX atau form
        console.log(html);
      });
    }
  </script>
</body>
</html>
