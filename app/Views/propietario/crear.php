<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota</title>
    <style>
        body {
            background: linear-gradient(to right, #fce4ec, #f3e5f5);
            font-family: 'Segoe UI', sans-serif;
            color: #4A148C;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #880e4f;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #6A1B9A;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4A148C;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrar Nueva Mascota</h2>
        <form action="<?= base_url('/propietario/guardarMascota') ?>" method="post">
            <input type="text" name="nom_mascota" placeholder="Nombre de la Mascota" required>
            <input type="text" name="especie" placeholder="Especie (ej. Perro, Gato)" required>
            <input type="text" name="raza" placeholder="Raza" required>
            <input type="date" name="fecha_nacimiento" required>
            <input type="date" name="fecha_vacunacion">
            <input type="text" name="nom_vacuna" placeholder="Nombre de la Vacuna">
            <input type="text" name="medicamento" placeholder="Medicamento">
            <input type="text" name="color" placeholder="Color">
            <select name="genero" required>
                <option value="">Seleccione Género</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
            <button type="submit">Guardar Mascota</button>
        </form>
    </div>
</body>
</html>
