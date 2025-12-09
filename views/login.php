<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nominal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
</head>
<body>
    <div class="grid-background"></div>
    
    <div class="auth-container">
        <div class="auth-card">
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

            <h1 class="auth-title">AUTHENTICATION</h1>
            
            <form action="<?php echo url('/login'); ?>" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input-control" placeholder="ENTER EMAIL" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="input-control" placeholder="ENTER PASSWORD" required>
                        <button type="button" class="toggle-password-btn" onclick="togglePassword('password', this)">SHOW</button>
                    </div>
                </div>

                <div class="input-group" style="margin-bottom: 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember" style="width: auto;">
                        <span style="color: var(--color-text-secondary); font-size: 0.85rem;">Remember me</span>
                    </label>
                </div>
                
                <button type="submit" class="btn-primary w-full mt-1">
                    LOGIN
                </button>
            </form>

            <div class="mt-2 text-center">
                <p class="mb-1" style="font-size: 0.85rem; color: var(--color-text-secondary);">NO CREDENTIALS?</p>
                <a href="<?php echo url('/register'); ?>" style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--color-black); text-decoration: underline;">REGISTER NEW USER</a>
            </div>

            <!-- Corner Accents -->
            <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 2px solid black; border-left: 2px solid black;"></span>
            <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 2px solid black; border-right: 2px solid black;"></span>
        </div>
    </div>
    <script src="<?php echo asset('script.js'); ?>"></script>
</body>
</html>
