<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'écoles - Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #1a3344;
            --secondary: #e74c3c;
            --light-bg: #f0f4f8;
            --dark-bg: #2c3e50;
            --card-bg: rgba(255, 255, 255, 0.1);
            --text-color: #fff;
            --accent: #f1c40f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary), var(--dark-bg));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text-color);
        }

        .container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group input {
            width: 50%;
            padding: 12px 40px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            font-size: 16px;
            color: var(--text-color);
            outline: none;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
        }
        button {
        background: #3498db; /* Nouvelle couleur (bleu clair) */
        color: #fff;
        padding: 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 50%;
        font-size: 18px;
        font-weight: 600;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

        button:hover {
            background: #0a3d62;
            transform: scale(1.05);
        }

        p {
            color: #ff6b6b;
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: var(--accent);
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-top: 15px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #dab10b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>

        <?php if (session('msg')): ?>
            <p><?= session('msg') ?></p>
        <?php endif; ?>

        <form action="<?= site_url('login/authenticate') ?>" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit">Se Connecter</button>
        </form>
    </div>
</body>
</html>