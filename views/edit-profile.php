<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Nominal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
</head>
<body>
    <div class="grid-background"></div>
    
    <header class="tech-header">
        <div class="container">
            <div class="logo">PROFILE</div>
            <button class="mobile-menu-toggle" id="mobile-menu-btn" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <a href="<?php echo url('/dashboard'); ?>">LINKS</a>
                <a href="<?php echo url('/edit-profile'); ?>" style="color: var(--color-black); font-weight: 600;">PROFILE</a>
                <a href="<?php echo url('/account'); ?>">ACCOUNT</a>
                <a href="<?php echo url('/logout'); ?>" style="color: var(--color-text-secondary);">LOGOUT</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding-top: 40px; max-width: 600px;">
        <?php if(isset($_SESSION['success'])): ?>
            <div style="background: #c6f6d5; padding: 0.8rem; margin-bottom: 1rem; border-left: 4px solid #2f855a; font-size: 0.9rem;">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div style="background: #fed7d7; padding: 0.8rem; margin-bottom: 1rem; border-left: 4px solid #c53030; font-size: 0.9rem;">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <h2 class="mb-2" style="font-size: 1.5rem; font-weight: 600;">PROFILE CONFIGURATION</h2>
        
        <div class="tech-card" style="margin-bottom: 2rem;">
            <form action="<?php echo url('/edit-profile'); ?>" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label>AVATAR SOURCE</label>
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 80px; height: 80px; background: #f5f5f5; border: 1px solid #000; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                            <?php if($userData['avatar']): ?>
                                <img src="<?php echo BASE_PATH; ?>/public/<?php echo $userData['avatar']; ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <span style="font-size: 2rem; font-family: var(--font-mono); font-weight: 700;"><?php echo strtoupper(substr($userData['name'], 0, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" name="avatar" id="avatar-input" accept="image/*" class="file-input-hidden" onchange="updateFileName(this)">
                            <label for="avatar-input" class="file-input-label">
                                <span class="file-input-button">CHOOSE FILE</span>
                                <span class="file-input-name" id="file-name-display">NO FILE CHOSEN</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="display-name">Display Name</label>
                    <input type="text" id="display-name" name="name" class="input-control" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Username</label>
                    <input type="text" class="input-control" value="<?php echo htmlspecialchars($userData['username']); ?>" readonly style="background: #f0f0f0; cursor: not-allowed;">
                </div>

                <div class="input-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="input-control" rows="4" style="resize: none; overflow: auto;"><?php echo htmlspecialchars($userData['bio'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="btn-primary w-full mt-1">SAVE CHANGES</button>
            </form>
            <!-- Corner Accents -->
            <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 2px solid black; border-left: 2px solid black;"></span>
            <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 2px solid black; border-right: 2px solid black;"></span>
        </div>
    </main>
    <script src="<?php echo asset('script.js'); ?>"></script>
</body>
</html>
