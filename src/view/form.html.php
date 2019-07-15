<html>
    <head>
        <title>Minimalist UI for testing</title>>
    </head>
    <body>
        <form method="POST">
            <textarea rows="20" cols="80" name="stops">[ { "from": "Adolfo Suárez Madrid–Barajas Airport, Spain", "to": "London Heathrow, UK" }, { "from": "Fazenda São Francisco Citros, Brazil", "to": "São Paulo–Guarulhos International Airport, Brazil" }, { "from": "London Heathrow, UK", "to": "Loft Digital, London, UK" }, { "from": "Porto International Airport, Portugal", "to": "Adolfo Suárez Madrid–Barajas Airport, Spain" }, { "from": "São Paulo–Guarulhos International Airport, Brazil", "to": "Porto International Airport, Portugal" } ]</textarea>
            <br><input type="submit">
        </form>
        RESULTS:
        <pre><?php echo $json; ?></pre>
    </body>
</html>

