<html>
    <head>
        <title>Minimalist UI for testing</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(function(){                
                var json = <?php echo $json; ?>;
                var output = '';
                for (var k in json) {
                    output += '<li>' + json[k] + '</li>';
                }
                var el = document.getElementById('results');
                el.innerHTML = output;
            });
        </script>
    </head>
    <body>
        <form method="POST">
            <textarea rows="20" cols="80" name="stops">[ { "from": "Adolfo Suárez Madrid–Barajas Airport, Spain", "to": "London Heathrow, UK" }, { "from": "Fazenda São Francisco Citros, Brazil", "to": "São Paulo–Guarulhos International Airport, Brazil" }, { "from": "London Heathrow, UK", "to": "Loft Digital, London, UK" }, { "from": "Porto International Airport, Portugal", "to": "Adolfo Suárez Madrid–Barajas Airport, Spain" }, { "from": "São Paulo–Guarulhos International Airport, Brazil", "to": "Porto International Airport, Portugal" } ]</textarea>
            <br><input type="submit">
        </form>
        RESULTS:
        <ul id="results"></ul>
    </body>
</html>

