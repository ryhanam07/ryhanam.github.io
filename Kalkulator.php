<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        
        .calculator {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            width: 300px;
        }
        
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .input-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #34495e;
            font-weight: 500;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        .buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        
        button {
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        .result {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            min-height: 20px;
        }
        
        .error {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .success {
            color: #27ae60;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>Kalkulat</h1>
        
        <form method="post" id="calculatorForm">
            <div class="input-group">
                <label for="num1">Angka Pertama:</label>
                <input type="number" id="num1" name="num1" step="any" required>
            </div>
            
            <div class="input-group">
                <label for="num2">Angka Kedua:</label>
                <input type="number" id="num2" name="num2" step="any" required>
            </div>
            
            <div class="buttons">
                <button type="button" onclick="calculate('add')">Tambah (+)</button>
                <button type="button" onclick="calculate('subtract')">Kurang (-)</button>
                <button type="button" onclick="calculate('multiply')">Kali (x)</button>
                <button type="button" onclick="calculate('divide')">Bagi (÷)</button>
            </div>
            
            <!-- Tambahkan input hidden untuk operation -->
            <input type="hidden" id="operation" name="operation" value="">
        </form>
        
        <div class="result" id="result">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $num1 = $_POST['num1'] ?? 0;
                $num2 = $_POST['num2'] ?? 0;
                $operation = $_POST['operation'] ?? '';
                $result = '';
                $error = '';
                
                if (!is_numeric($num1) || !is_numeric($num2)) {
                    $error = "Masukkan angka yang valid!";
                } else {
                    if ($operation === 'add') {
                        $result = $num1 + $num2;
                    } elseif ($operation === 'subtract') {
                        $result = $num1 - $num2;
                    } elseif ($operation === 'multiply') {
                        $result = $num1 * $num2;
                    } elseif ($operation === 'divide') {
                        if ($num2 == 0) {
                            $error = "Tidak bisa membagi dengan nol!😡";
                        } else {
                            $result = $num1 / $num2;
                        }
                    }
                }
                
                if ($error) {
                    echo '<span class="error">' . $error . '</span>';
                } elseif ($result !== '') {
                    echo '<span class="success">Hasil: ' . $result . '🤗</span>';
                }
            }
            ?>
        </div>
    </div>

    <script>
        function calculate(operation) {
            const num1 = document.getElementById('num1').value.trim();
            const num2 = document.getElementById('num2').value.trim();
            
            if (num1 === '' || num2 === '') {
                alert('Mohon masukkan kedua angka!');
                return false;
            }
            
            // Set nilai operation dan submit form
            document.getElementById('operation').value = operation;
            document.getElementById('calculatorForm').submit();
        }
    </script>
</body>
</html>