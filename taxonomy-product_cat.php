<?php get_header(); ?>

<div class="wrap-grande">
    <div class="wrap-container sec-cat-hero">
        <span class="desktop-parrafo" style="color: var(--Texto-Secundario);">
            CATEGORÍA
        </span>
        <h1 class="desktop-h1">
            <?php single_cat_title();?>
        </h1>
    </div>
    <div class="wrap-container sec-body">
        <div class="sidebar"></div>
        <div class="product-list"></div>
    </div>
</div>

<?php get_footer(); ?>
