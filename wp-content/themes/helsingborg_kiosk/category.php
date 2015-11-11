<?php
get_header();

    if (has_subcategories($cat)) {
        get_template_part('poi-categories');
    } else {
        get_template_part('poi-list');
    }

get_footer();
?>