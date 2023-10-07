<!-- settings-form.php -->
<div class="wrap">
    <h1>Auto Generate Navigation Settings</h1>
    <form method="post" action="">

        <label for="articleElement" class="form-label">Article Element:</label>
        <input type="text" id="articleElement" name="articleElement" value="<?php echo esc_attr(get_option('auto_generate_navigation_article_element')); ?>" placeholder="#article" />
        <br />

        <label for="selector" class="form-label">Selector:</label>
        <input type="text" id="selector" name="selector" value="<?php echo esc_attr(get_option('auto_generate_navigation_selector')); ?>" placeholder="h1,h2,h3,h4,h5" />
        <br />

        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo esc_attr(get_option('auto_generate_navigation_title')); ?>" placeholder="Title" />
        <br />

        <label for="scrollElement" class="form-label">Scroll Element:</label>
        <input type="text" id="scrollElement" name="scrollElement" value="<?php echo esc_attr(get_option('auto_generate_navigation_scroll_element')); ?>" placeholder="html,body" />
        <br />

        <label for="position" class="form-label">Position:</label>
        <input type="text" id="position" name="position" value="<?php echo esc_attr(get_option('auto_generate_navigation_position')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_position')); ?>" />
        <br />

        <label for="parentElement" class="form-label">Parent Element:</label>
        <input type="text" id="parentElement" name="parentElement" value="<?php echo esc_attr(get_option('auto_generate_navigation_parent_element')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_parent_element')); ?>" />
        <br />

        <label for="placement" class="form-label">Placement:</label>
        <input type="text" id="placement" name="placement" list="options" value="<?php echo esc_attr(get_option('auto_generate_navigation_placement')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_placement')); ?>" />
        <datalist id="options">
            <option value="ltr">
            <option value="rtl">
            <option value="ttb">
            <option value="btt">
        </datalist>
        <br />

        <label for="stickyHeight" class="form-label">Sticky Height:</label>
        <input type="number" id="stickyHeight" name="stickyHeight" value="<?php echo esc_attr(get_option('auto_generate_navigation_sticky_height')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_sticky_height')); ?>" />
        <br />

        <label for="showCode" class="form-label">Show Code:</label>
        <input type="checkbox" id="showCode" name="showCode" <?php echo (get_option('auto_generate_navigation_show_code') == 1) ? 'checked' : ''; ?> />
        <br />

        <label for="animationCurrent" class="form-label">Animation Current:</label>
        <input type="checkbox" id="animationCurrent" name="animationCurrent" <?php echo (get_option('auto_generate_navigation_animation_current') == 1) ? 'checked' : ''; ?> />
        <br />

        <label for="hasToolbar" class="form-label">HasToolbar:</label>
        <input type="checkbox" id="hasToolbar" name="hasToolbar" <?php echo (get_option('auto_generate_navigation_animation_has_toolbar') == 1) ? 'checked' : ''; ?> />
        <br />

        <label for="anchorURL" class="form-label">AnchorURL:</label>
        <input type="text" id="anchorURL" name="anchorURL" value="<?php echo esc_attr(get_option('auto_generate_navigation_anchor_url')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_anchor_url')); ?>" />
        <br />

        <label for="homepage" class="form-label">Homepage:</label>
        <input type="text" id="homepage" name="homepage" value="<?php echo esc_attr(get_option('auto_generate_navigation_homepage')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_homepage')); ?>" />
        <br />

        <label for="git" class="form-label">Git:</label>
        <input type="text" id="git" name="git" value="<?php echo esc_attr(get_option('auto_generate_navigation_git')); ?>" placeholder="<?php echo esc_attr(get_option('auto_generate_navigation_git')); ?>" />
        <br />

        <?php submit_button('Save Settings'); ?>
    </form>
</div>

<style>
    .form-label {
        display: inline-block;
        width: 150px; /* Adjust the width as needed */
        text-align: left;
        padding-right: 10px; /* Add some spacing between label and input */
    }
</style>
