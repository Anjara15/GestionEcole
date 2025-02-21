<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'écoles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a3344;
            --secondary: #e74c3c;
            --light-bg: #f0f4f8;
            --dark-bg: #2c3e50;
            --card-bg: #ffffff;
            --text-color: #1a3344;
            --accent: #f1c40f;
        }

        [data-theme="dark"] {
            --primary: #3498db;
            --secondary: #e74c3c;
            --light-bg: #2c3e50;
            --dark-bg: #1a252f;
            --card-bg: #34495e;
            --text-color: #ecf0f1;
            --accent: #e67e22;
        }

        [data-theme="colorful"] {
            --primary: #2ecc71;
            --secondary: #e74c3c;
            --light-bg: #dfe6e9;
            --dark-bg: #b2bec3;
            --card-bg: #ffffff;
            --text-color: #2d3436;
            --accent: #f1c40f;
        }

        body {
            font-family: 'Poppins', 'Open Sans', sans-serif;
            background: var(--light-bg);
            min-height: 100vh;
            margin: 0;
            color: var(--text-color);
            display: flex;
            transition: background 0.3s ease;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: var(--dark-bg);
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100%;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .toggle-btn {
            font-size: 24px;
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background: var(--primary);
            transform: translateX(5px);
        }

        .sidebar i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar.collapsed a span {
            display: none !important;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 70px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-container {
            background: var(--card-bg);
            border: 1px solid var(--primary);
            border-radius: 30px;
            padding: 10px 20px;
            width: 350px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .search-container input {
            border: none;
            outline: none;
            width: 100%;
            background: transparent;
            color: var(--text-color);
        }

        .search-container i {
            color: var(--primary);
            margin-right: 10px;
        }

        /* Style général du conteneur */
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-family: Arial, sans-serif;
        }

        .table-wrapper {
            overflow-x: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        .table thead {
            background: #3498db;
            color: white;
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        .table tbody tr {
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #333;
        }

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-right: 5px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #2ecc71;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: #27ae60;
        }

        .btn-warning {
            background: #f1c40f;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background: #e1b10e;
        }

        .btn-danger {
            background: #e74c3c;
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .fas {
            margin-right: 5px;
        }

        .text-center {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        @media (max-width: 768px) {
            .table th, .table td {
                padding: 10px;
            }
            .sidebar {
                width: 70px;
            }
            .btn {
                display: inline-block;
                margin: 2px 5px;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        <a href="<?= site_url('dashboard')?>"><i class="fas fa-chart-bar"></i><span>Dashboard</span></a>
        <a href="<?= site_url('students')?>"><i class="fas fa-user-graduate"></i><span>Étudiants</span></a>
        <a href="<?= site_url('teachers')?>"><i class="fas fa-chalkboard-teacher"></i><span>Professeurs</span></a>
        <a href="<?= site_url('matieres')?>"><i class="fas fa-book"></i><span>Matières</span></a>
        <a href="<?= site_url('classroom')?>"><i class="fas fa-school"></i><span>Salles</span></a>
        <a href="<?= site_url('schedule')?>"><i class="fas fa-calendar-alt"></i><span>Événements</span></a>
        <a href="<?= site_url('logout')?>" ><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
    </aside>

    <div class="main-content">
        <div class="top-bar">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Rechercher des professeurs..." onkeyup="filterTable()">
            </div>
            <button class="theme-toggle" onclick="toggleTheme()"><i class="fas fa-moon"></i> Mode Sombre</button>
        </div>

        <div class="content-container">
        <h1 class="mt-5">Liste des Matières</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th>Nom de la matière</th>
                    <th>Enseignant</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($matieres) && is_array($matieres)): ?>
                    <?php foreach ($matieres as $matiere): ?>
                        <tr>
                            <td><?= esc($matiere['niveau']) ?></td>
                            <td><?= esc($matiere['nom_matiere']) ?></td>
                            <td><?= esc($matiere['enseignant']) ?></td>
                            <td><?= esc($matiere['type']) ?></td>
                            <td>
                                <a href="<?= site_url('matieres/edit/' . esc($matiere['id'])) ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="<?= site_url('matieres/delete/' . esc($matiere['id'])) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucune matière trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="<?= site_url('matieres/add') ?>" class="btn btn-primary mt-3">Ajouter une matière</a>
        </div>	
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        }

        function toggleTheme() {
            document.body.dataset.theme = document.body.dataset.theme === 'dark' ? '' : 'dark';
        }

        function filterTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('professorTable');
            const rows = table.getElementsByTagName('tr');
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].textContent.toLowerCase().includes(input)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</body>
</html>