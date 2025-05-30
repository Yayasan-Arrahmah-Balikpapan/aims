<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Website Builder</title>

    <link href="{{ asset('assets/vvvebjs/libs/builder/css/builder.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vvvebjs/libs/builder/css/editor.css') }}" rel="stylesheet">
</head>
<body>

<div id="vvveb-builder"></div>

<!-- jQuery -->
<script src="{{ asset('assets/vvvebjs/libs/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap & Popper -->
<script src="{{ asset('assets/vvvebjs/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vvvebjs/js/bootstrap.min.js') }}"></script>

<!-- VvvebJs Core -->
<script src="{{ asset('assets/vvvebjs/libs/builder/builder.js') }}"></script>
<script src="{{ asset('assets/vvvebjs/libs/builder/undo.js') }}"></script>
<script src="{{ asset('assets/vvvebjs/libs/builder/inputs.js') }}"></script>
<script src="{{ asset('assets/vvvebjs/libs/builder/components-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vvvebjs/libs/builder/components-widgets.js') }}"></script>

<script>
    let pages = [
        {
            name: "narrow-jumbotron",
            title: "Jumbotron",
            url: "{{ asset('assets/vvvebjs/demo/narrow-jumbotron/index.html') }}",
            file: "demo/narrow-jumbotron/index.html"
        },
        {
            name: "landing-page",
            title: "Landing Page",
            url: "{{ asset('assets/vvvebjs/demo/landing/index.html') }}",
            file: "demo/landing/index.html"
        }
    ];

    let firstPage = Object.keys(pages)[0];

    Vvveb.Builder.init(pages[0].url, function () {
        console.log("Builder siap!");
    });

    Vvveb.Gui.init();
    Vvveb.FileManager.init();
    Vvveb.SectionList.init();
    Vvveb.Breadcrumb.init();

    Vvveb.FileManager.addPages(pages);
    Vvveb.FileManager.loadPage(pages[0].name);
    Vvveb.Gui.toggleRightColumn(false);
</script>

</body>
</html>
