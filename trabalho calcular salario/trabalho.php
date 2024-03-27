<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário de Vendedor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .container h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        button {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Calculadora de Salário de Vendedor</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $meta_semanal = $_POST["meta_semanal"];
            $meta_mensal = $_POST["meta_mensal"];

            $salario_minimo = 1500;
            $meta_semanal_total = 20000;
            $meta_mensal_total = 80000;

            $bonus_semanal = ($meta_semanal / $meta_semanal_total) * ($salario_minimo * 0.01);
            $excedente_semanal = ($meta_semanal > $meta_semanal_total) ? ($meta_semanal - $meta_semanal_total) * 0.05 : 0;
            $excedente_mensal = ($meta_mensal > $meta_mensal_total && $meta_semanal <= $meta_semanal_total) ? ($meta_mensal - $meta_mensal_total) * 0.10 : 0;

            $salario_final = $salario_minimo + $bonus_semanal + $excedente_semanal + $excedente_mensal;

            echo "<h2>Resultado do Cálculo:</h2>";
            echo "<p>Nome do Vendedor: $nome</p>";
            echo "<p>Salário Final: R$ " . number_format($salario_final, 2, ',', '.') . "</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nome">Nome do Vendedor:</label>
            <input type="text" id="nome" name="nome" required><br><br>
            <label for="meta_semanal">Meta Semanal (R$):</label>
            <input type="number" id="meta_semanal" name="meta_semanal" required><br><br>
            <label for="meta_mensal">Meta Mensal (R$):</label>
            <input type="number" id="meta_mensal" name="meta_mensal" required><br><br>
            <button type="submit">Calcular Salário</button>
        </form>
    </div>
</body>
</html>
