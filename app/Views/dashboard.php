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
            --accent: #f1c40f; /* Jaune pour les cercles */
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
            display: none;
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

        .theme-selector select {
            padding: 10px;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Statistiques */
        .content-container {
            background: var(--card-bg);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .content-container h3 {
            color: var(--primary);
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 50px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .stat-box {
            position: relative;
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-box i {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .stat-box h4 {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .stat-box p {
            font-size: 40px;
            color: var(--primary);
            font-weight: 700;
        }

        /* Cercle de progression */
        .progress-circle {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 60px;
            height: 60px;
        }

        .progress-circle svg {
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 5;
            stroke: var(--accent);
            stroke-dasharray: 157;
            stroke-dashoffset: calc(157 - (157 * var(--percent)) / 100);
            transition: stroke-dashoffset 0.5s ease;
        }

        /* Notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--primary);
            color: #fff;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            opacity: 0;
            animation: fadeInOut 3s ease forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            20% { opacity: 1; transform: translateY(0); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .search-container {
                width: 100%;
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
        <a href="<?= site_url('logout')?>"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
    </aside>

    <div class="main-content">
        <div class="top-bar">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher...">
            </div>
            <div class="theme-selector">
                <select onchange="changeTheme(this.value)">
                    <option value="light">Clair</option>
                    <option value="dark">Sombre</option>
                    <option value="colorful">Coloré</option>
                </select>
            </div>
        </div>

        <section class="content-container">
            <h3>Statistiques générales</h3>
            <div class="stats">
                <div class="stat-box">
                    <i class="fas fa-user-graduate"></i>
                    <h4>Étudiants</h4>
                    <p data-count="<?= esc($totalStudents) ?>">0</p>
                    <div class="progress-circle" style="--percent: 75;">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" />
                            <circle cx="30" cy="30" r="25" />
                        </svg>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h4>Professeurs</h4>
                    <p data-count="<?= esc($totalTeacher) ?>">0</p>
                    <div class="progress-circle" style="--percent: 60;">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" />
                            <circle cx="30" cy="30" r="25" />
                        </svg>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-book"></i>
                    <h4>Matières</h4>
                    <p data-count="<?= esc($totalMatieres) ?>">0</p>
                    <div class="progress-circle" style="--percent: 85;">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" />
                            <circle cx="30" cy="30" r="25" />
                        </svg>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-school"></i>
                    <h4>Salles</h4>
                    <p data-count="<?= esc($totalClassrooms) ?>">0</p>
                    <div class="progress-circle" style="--percent: 50;">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" />
                            <circle cx="30" cy="30" r="25" />
                        </svg>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fas fa-calendar-alt"></i>
                    <h4>Événements</h4>
                    <p data-count="<?= esc($totalEvents) ?>">0</p>
                    <div class="progress-circle" style="--percent: 90;">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e0e0e0" />
                            <circle cx="30" cy="30" r="25" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php if (session('msg')): ?>
        <div class="toast"><?= session('msg') ?></div>
    <?php endif; ?>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        }

        // Change Theme
        function changeTheme(theme) {
            document.body.dataset.theme = theme;
        }

        // Animate Counters
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.stat-box p');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                let count = 0;
                const speed = 50; // Vitesse d'animation
                const increment = target / speed;

                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.textContent = Math.ceil(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.textContent = target;
                    }
                };
                updateCount();
            });
        });
    </script>
</body>
</html>