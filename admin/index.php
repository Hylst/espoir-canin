<?php
require_once 'auth.php';

requireLogin();

$eventsFile = '../assets/events.json';
$message = '';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $events = json_decode(file_get_contents($eventsFile), true) ?? [];
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $newId = empty($events) ? 1 : max(array_column($events, 'id')) + 1;
            
            $newEvent = [
                'id' => $newId,
                'title' => $_POST['title'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'type' => $_POST['type'],
                'description' => $_POST['description'],
                'image' => $_POST['type'] === 'balade' ? 'assets/images/collectif-main.webp' : 'assets/images/collectif-side.webp' // Auto select image based on type for simplicity
            ];
            
            // Sort by date
            $events[] = $newEvent;
            usort($events, function($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            
            if (file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                $message = "Événement ajouté avec succès !";
            } else {
                $message = "Erreur lors de l'enregistrement.";
            }

        } elseif ($_POST['action'] === 'delete') {
            $idToDelete = (int)$_POST['id'];
            $events = array_filter($events, function($e) use ($idToDelete) {
                return $e['id'] !== $idToDelete;
            });
            // Re-index array
            $events = array_values($events);
            
            file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $message = "Événement supprimé.";
        }
    }
}

// Read events for display
$events = json_decode(file_get_contents($eventsFile), true) ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Planning - Espoir Canin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: var(--color-surface);
            padding: 20px;
            border-radius: 12px;
        }
        .event-list {
            display: grid;
            gap: 15px;
        }
        .admin-event-card {
            background: var(--color-surface);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-form {
            background: var(--color-surface);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--glass-border);
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .admin-event-card { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid var(--glass-border);
            background: #111; /* Solid dark background for inputs */
            color: white;
        }
        option {
            background: #111;
            color: white;
        }
        label { font-size: 0.9rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="header">
            <div>
                <h1>Gestion Planning</h1>
                <p>Ajoutez ou supprimez des dates.</p>
            </div>
            <a href="logout.php" class="btn" style="background: #333;">Déconnexion</a>
        </div>

        <?php if ($message): ?>
            <div style="background: rgba(89, 214, 0, 0.1); color: #59d600; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'ajout -->
        <div class="add-form">
            <h2 style="margin-bottom: 20px;">Ajouter un événement</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-grid">
                    <div>
                        <label>Titre de l'événement</label>
                        <input type="text" name="title" placeholder="Ex: Balade Collective - Schirmeck" required>
                    </div>
                    <div>
                        <label>Type</label>
                        <select name="type">
                            <option value="balade">Balade</option>
                            <option value="cours">Cours Collectif</option>
                            <option value="mantrailing">Mantrailing</option>
                            <option value="stage">Stage / Autre</option>
                        </select>
                    </div>
                    <div>
                        <label>Date</label>
                        <input type="date" name="date" required>
                    </div>
                    <div>
                        <label>Heure</label>
                        <input type="time" name="time" required>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label>Description (Lieu, Prix, Infos)</label>
                        <textarea name="description" rows="2" placeholder="Ex: Bergopré. 15€. Inscription par SMS."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Ajouter au planning</button>
            </form>
        </div>

        <!-- Liste des événements -->
        <h2>Événements à venir (<?= count($events) ?>)</h2>
        <div class="event-list">
            <?php foreach ($events as $event): ?>
                <div class="admin-event-card">
                    <div>
                        <div style="font-weight: bold; font-size: 1.1rem; color: var(--color-primary);">
                            <?= date('d/m/Y', strtotime($event['date'])) ?> à <?= htmlspecialchars($event['time']) ?>
                        </div>
                        <div><?= htmlspecialchars($event['title']) ?></div>
                        <div style="font-size: 0.85rem; opacity: 0.7;"><?= htmlspecialchars($event['description']) ?></div>
                    </div>
                    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $event['id'] ?>">
                        <button type="submit" style="background: #ff4444; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                            Supprimer
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
