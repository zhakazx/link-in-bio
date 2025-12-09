<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Nominal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
</head>
<body>
    <div class="grid-background"></div>
    
    <header class="tech-header">
        <div class="container">
            <div class="logo">ACCOUNT</div>
            <button class="mobile-menu-toggle" id="mobile-menu-btn" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <a href="<?php echo url('/dashboard'); ?>">LINKS</a>
                <a href="<?php echo url('/edit-profile'); ?>">PROFILE</a>
                <a href="<?php echo url('/account'); ?>" style="color: var(--color-black); font-weight: 600;">ACCOUNT</a>
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

        <h2 class="mb-2" style="font-size: 1.5rem; font-weight: 600;">SECURITY SETTINGS</h2>
        
        <div class="tech-card mb-2">
            <h3 style="font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 1.5rem; text-transform: uppercase;">// Update Credentials</h3>
            <form action="<?php echo url('/change-password'); ?>" method="POST">
                <div class="input-group">
                    <label for="current-password">Current Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="current-password" name="current_password" class="input-control" placeholder="ENTER CURRENT PASSWORD" required>
                        <button type="button" class="toggle-password-btn" onclick="togglePassword('current-password', this)">SHOW</button>
                    </div>
                </div>
                <div class="input-group">
                    <label for="new-password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="new-password" name="new_password" class="input-control" placeholder="ENTER NEW PASSWORD" required>
                        <button type="button" class="toggle-password-btn" onclick="togglePassword('new-password', this)">SHOW</button>
                    </div>
                </div>
                <button type="submit" class="btn-primary">UPDATE PASSWORD</button>
            </form>
            <!-- Corner Accents -->
            <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 2px solid black; border-left: 2px solid black;"></span>
            <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 2px solid black; border-right: 2px solid black;"></span>
        </div>

        <div class="tech-card" style="border-color: #ff4d4d; padding: 30px; min-height: auto; margin-bottom: 2rem;">
            <h3 style="font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 1.5rem; text-transform: uppercase; color: #ff4d4d;">// Danger Zone</h3>
            <p style="font-size: 0.9rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; line-height: 1.5;">
                Once you delete your account, there is no going back. Please be certain.
            </p>
            <form action="<?php echo url('/delete-account'); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone!')">
                <button type="submit" class="btn-primary" style="background: #ff4d4d; border-color: #ff4d4d; width: 100%;">DELETE ACCOUNT</button>
            </form>
            
            <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 2px solid #ff4d4d; border-left: 2px solid #ff4d4d;"></span>
            <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 2px solid #ff4d4d; border-right: 2px solid #ff4d4d;"></span>
        </div>
    </main>
    <script src="<?php echo asset('script.js'); ?>"></script>
</body>
</html>
