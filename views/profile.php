<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($userData['name']); ?> - Nominal Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
    <script src="https://kit.fontawesome.com/d3075a2270.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="grid-background"></div>
    <div class="profile-page" style="background-color: transparent;">
        <div class="profile-dossier">
            <div class="profile-avatar">
                <!-- Avatar image -->
                <?php if($userData['avatar']): ?>
                    <img src="<?php echo BASE_PATH; ?>/public/<?php echo $userData['avatar']; ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <div style="width: 100%; height: 100%; background: #f5f5f5; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #333;">
                        <?php echo strtoupper(substr($userData['name'], 0, 1)); ?>
                    </div>
                <?php endif; ?>
                
                <span class="corner-top-left" style="position: absolute; top: -1px; left: -1px; width: 10px; height: 10px; border-top: 2px solid black; border-left: 2px solid black;"></span>
                <span class="corner-bottom-right" style="position: absolute; bottom: -1px; right: -1px; width: 10px; height: 10px; border-bottom: 2px solid black; border-right: 2px solid black;"></span>
            </div>
            
            <h1 class="profile-name"><?php echo htmlspecialchars($userData['name']); ?></h1>
            <p class="profile-bio"><?php echo nl2br(htmlspecialchars($userData['bio'] ?? '')); ?></p>
    
            <div class="profile-links">
                <?php if(empty($links)): ?>
                    <div style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--color-text-secondary); padding: 1rem; border: 1px dashed #ccc; width: 100%; text-align: center;">
                        LINK DATA NOT FOUND
                    </div>
                <?php else: ?>
                    <?php foreach($links as $link): ?>
                        <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="profile-link-btn">
                            <?php echo htmlspecialchars($link['title']); ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="mt-2" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--color-text-secondary); letter-spacing: 0.05em;">
                COPYRIGHT ZHAKAZX
            </div>

            <!-- Dossier Corners -->
            <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 3px solid black; border-left: 3px solid black;"></span>
            <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 3px solid black; border-right: 3px solid black;"></span>
        </div>
    </div>
</body>
</html>
