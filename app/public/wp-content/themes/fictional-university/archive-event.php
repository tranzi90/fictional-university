<?php get_header();

    pageBanner(array(
            'title' => 'All Events',
            'subtitle' => 'See what awaits us in the future...'
    ));
?>
    <div class="container container--narrow page-section">
        <?php
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/event');
        }
        echo paginate_links();
        ?>

        <a href="<?php echo site_url('past-events') ?>">Past events</a>
    </div>

<?php get_footer();