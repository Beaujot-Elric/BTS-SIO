<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du médicament</title>
    <!-- Inclure les styles CSS si nécessaire -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include "./Vue/components/header.component.html"; ?>
    <div style="min-height: 100vh">

    
    <?php if (!empty($details)): ?>
        <table class="table">
            <tr>
                <th>Description</th>
            </tr>
            <?php foreach ($details as $medicament): ?>
                <tr>
                    <td><?php echo $medicament["description"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun détail trouvé pour ce médicament.</p>
    <?php endif; ?>
    </div>
<?php include "./Vue/components/footer.component.html"; ?>
</body>
</html>
