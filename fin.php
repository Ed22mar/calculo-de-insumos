<?php
// Função para Somar o valor dos Insumos em Em Kwanza
function somaValorInsumos($valorArroz, $valorNpk, $valorKcl,$valorUreia) {
    return $valorArroz + $valorNpk + $valorKcl + $valorUreia;
}
// Função para Dividir o valor dos Insumos somados pela taxa de Compra 510
function convertKG($totalKwanza,$taxaCompra){
    return $totalKwanza / $taxaCompra;
}
// função para converter o valor de KG em Sacos
function converterSacos($valorKG,$taxaSaca){
    return $valorKG / $taxaSaca;
}
// função para converter o Seguro
function converterSeguro($valorSeguro,$taxaCompra){ 
    return $valorSeguro / $taxaCompra;
}
function converterSeguroSacos($valorSeguroKg,$taxaSaca){
    return $valorSeguroKg / $taxaSaca; 
}
// função para converter o insumo + o Seguro
function somaInsumoSeguro($valorKG,$valorSeguroKg,$valorSolo){
    return $valorKG + $valorSeguroKg + $valorSolo;
}
function convertInsumoSeguroSacos($valorInsumoSeguro,$taxaSaca){
    return $valorInsumoSeguro / $taxaSaca;
}


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valores recebidos
    $valorArroz = $_POST['valorArroz'] * $precoArroz = 84000; 
    $valorNpk = $_POST['valorNpk'] * $precoNpk = 44953.125;
    $valorKcl= $_POST['valorKcl'] * $precoKcl= 40687.5;
    $valorUreia = $_POST['valorUreia'] * $precoUreia = 36050;
    $valorSeguro = $_POST['valorSeguro'] * $precoSeguro = 17500;
    $valorSolo = $_POST['valorSolo'] * $precoSelo = 169;

    //Taxas
    $taxaCompra = 510;
    $taxaSaca = 50;
    // Saida dos Resultados
    echo "<div class='container mt-5 col-6'>";
        echo "<h1 class='text-primary'>Resultados dos Cálculos</h1>";
        echo "<h2>Multiplicação dos Insumos em Kwanza</h2>";
        echo "<p> ARROZ: " . number_format($valorArroz, 2, ',', '.') ." KZ$ " . " NPK: " . number_format($valorNpk, 2, ',', '.') . " KZ$ " . "KCL: ". number_format($valorKcl, 2, ',', '.') . " KZ$ " . " UREIA: " . number_format($valorUreia, 2, ',', '.') . " KZ$ </p>";
        echo "<h2>Soma Dos Insumos</h2>";
        // Valor Insumos
        echo "<p><strong>Soma de todos Insumos em KZ : </strong>" .number_format($totalKwanza = somaValorInsumos($valorArroz, $valorNpk,$valorKcl,$valorUreia), 2, ',', '.') . " <strong> Para o contrato BCI</strong></p>";
        echo "<p> <strong>Resultados dos Insumos em KG: </strong> " .number_format($valorKG = convertKG($totalKwanza,$taxaCompra), 2, ',', '.')." <strong> Para a guia de entrega </strong></p>"; 
        echo "<p> <strong> Resultados dos Insumos em SC: </strong> " .number_format($valorSacos = converterSacos($valorKG,$taxaSaca), 2, ',', '.')."<strong> Para a guia de entrega </strong><br>";

        // Exibe o valor convertido
        echo "<h2> Calculo do Seguro </h2>";
        echo "<p><strong>Resultado em KG: </strong>" .number_format($valorSeguroKg = converterSeguro($valorSeguro,$taxaCompra,$taxaSaca), 2, ',', '.');
        //echo " Resultado em SC: " .number_format(converterSeguroSacos($valorSeguroKg,$taxaSaca), 2, ',', '.');

        //Soma do Insumo + Seguro
        echo "<h2>Soma do Insumo + Seguro + Mecanização</h2>";
        echo "<p><strong>Resultado em KG: </strong>" . number_format($valorInsumoSeguro = somaInsumoSeguro($valorKG,$valorSeguroKg,$valorSolo), 2, ',', '.') ."<strong> Para o Contrato FIN </strong>";
        echo "<p><strong>Resultado em Sacos: </strong>" . number_format(convertInsumoSeguroSacos($valorInsumoSeguro,$taxaSaca), 2, ',', '.') ."<strong> Para o Contrato FIN </strong>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Conversor de Insumos</title>
</head>
<body class="bg-light">
    <div class="container mt-5 col-6">
        <a href="index.php">Voltar</a>
        <h1 class="text-center mb-4">Conversor de Insumos - FIN</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="valorArroz" class="form-label">Digite a quantidade do Arroz:</label>
                <input type="number" step="0.01" name="valorArroz" id="valorArroz" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="valorNpk" class="form-label">Digite a quantidade do NPK:</label>
                <input type="number" step="0.01" name="valorNpk" id="valorNpk" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="valorKcl" class="form-label">Digite a quantidade do KCL:</label>
                <input type="number" step="0.01" name="valorKcl" id="valorKcl" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="valorUreia" class="form-label">Digite a quantidade do UREIA:</label>
                <input type="number" step="0.01" name="valorUreia" id="valorUreia" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="valorSeguro" class="form-label">Hectar Seguro:</label>
                <input type="number" step="0.01" name="valorSeguro" id="valorSeguro" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="valorSolo" class="form-label">Hectar Preparo de Solo:</label>
                <input type="number" step="0.01" name="valorSolo" id="valorSolo" class="form-control" min="0" required>
            </div>
            <button type="submit" class="btn btn-success">Converter</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>