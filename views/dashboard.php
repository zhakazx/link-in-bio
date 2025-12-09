<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Nominal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
</head>
<body>
    <div class="grid-background"></div>
    
    <header class="tech-header">
        <div class="container">
            <div class="logo">DASHBOARD</div>
            <button class="mobile-menu-toggle" id="mobile-menu-btn" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <a href="<?php echo url('/dashboard'); ?>" style="color: var(--color-black); font-weight: 600;">LINKS</a>
                <a href="<?php echo url('/edit-profile'); ?>">PROFILE</a>
                <a href="<?php echo url('/account'); ?>">ACCOUNT</a>
                <a href="<?php echo url('/logout'); ?>" style="color: var(--color-text-secondary);">LOGOUT</a>
            </nav>
        </div>
    </header>

    <main class="container dashboard-layout">
        <!-- Main Content: Link Manager -->
        <div>
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

            <div class="dashboard-header">
                <h2 style="font-size: 1.5rem; font-weight: 600;">ACTIVE LINKS</h2>
                <div>
                    <a href="<?php echo url('/u/' . $userData['username']); ?>" target="_blank" class="btn-primary" style="font-size: 0.8rem;">OPEN PUBLIC VIEW</a>
                </div>
            </div>

            <!-- Add Link Form -->
            <div class="tech-card mb-2" style="padding: 20px; min-height:auto;">
                <h3 style="font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 1rem; text-transform: uppercase;">// Configure New Link</h3>
                <form action="<?php echo url('/link/create'); ?>" method="POST">
                    <div class="input-group">
                        <input type="text" name="title" class="input-control" placeholder="LINK TITLE" required>
                    </div>
                    <div class="input-group">
                        <input type="url" name="url" class="input-control" placeholder="DESTINATION URL (https://example.com)" required>
                    </div>
                    <button type="submit" class="btn-primary">+ NEW LINK</button>
                </form>
                <!-- Corner Accents -->
                <span class="corner-top-left" style="position: absolute; top: 0; left: 0; width: 20px; height: 20px; border-top: 2px solid black; border-left: 2px solid black;"></span>
                <span class="corner-bottom-right" style="position: absolute; bottom: 0; right: 0; width: 20px; height: 20px; border-bottom: 2px solid black; border-right: 2px solid black;"></span>
            </div>

            <!-- Link List -->
            <div class="link-list">
                <?php if(empty($links)): ?>
                    <div style="text-align: center; padding: 2rem; color: var(--color-text-secondary); border: 1px dashed var(--color-text-secondary);">
                        No links configured. Initialize your first link above.
                    </div>
                <?php else: ?>
                    <?php foreach($links as $link): ?>
                        <div class="link-item" id="link-<?php echo $link['id']; ?>">
                            <!-- Display Mode -->
                            <div class="link-display" id="display-<?php echo $link['id']; ?>" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                                <div class="link-info">
                                    <h4><?php echo htmlspecialchars($link['title']); ?></h4>
                                    <small><?php echo htmlspecialchars($link['url']); ?></small>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button type="button" class="action-btn" onclick="toggleEdit(<?php echo $link['id']; ?>)">EDIT</button>
                                    <form action="<?php echo url('/link/delete'); ?>" method="POST" onsubmit="return confirm('Delete this link?')" style="margin:0;">
                                        <input type="hidden" name="id" value="<?php echo $link['id']; ?>">
                                        <button type="submit" class="action-btn">DEL</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Mode -->
                            <div class="link-edit" id="edit-<?php echo $link['id']; ?>" style="display: none; width: 100%;">
                                <form action="<?php echo url('/link/update'); ?>" method="POST" style="width: 100%;">
                                    <input type="hidden" name="id" value="<?php echo $link['id']; ?>">
                                    <div style="display: flex; gap: 0.5rem; width: 100%; flex-direction: column;">
                                        <input type="text" name="title" class="input-control" value="<?php echo htmlspecialchars($link['title']); ?>" required style="margin-bottom: 0.5rem;" placeholder="LINK TITLE">
                                        <input type="url" name="url" class="input-control" value="<?php echo htmlspecialchars($link['url']); ?>" required style="margin-bottom: 0.5rem;" placeholder="DESTINATION URL">
                                        <div style="display: flex; gap: 0.5rem;">
                                            <button type="submit" class="btn-primary" style="padding: 8px 16px; font-size: 0.75rem;">SAVE</button>
                                            <button type="button" class="action-btn" onclick="toggleEdit(<?php echo $link['id']; ?>)">CANCEL</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar: Preview -->
        <div>
            <div class="device-preview">
                <div class="device-screen">
                    <iframe src="<?php echo url('/u/' . $userData['username']); ?>" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>
    </main>
    <script>
        function toggleEdit(linkId) {
            const displayDiv = document.getElementById('display-' + linkId);
            const editDiv = document.getElementById('edit-' + linkId);
            
            if (displayDiv.style.display === 'none') {
                displayDiv.style.display = 'flex';
                editDiv.style.display = 'none';
            } else {
                displayDiv.style.display = 'none';
                editDiv.style.display = 'block';
            }
        }
    </script>
    <script src="<?php echo asset('script.js'); ?>"></script>
</body>
</html>
