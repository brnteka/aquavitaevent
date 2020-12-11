<?php $portfolio_list = carbon_get_the_post_meta('video_list');?>
<div class="tile <?php if ($portfolio_list): ?> tile-is-movable <?php endif;?> tile-hidden w-full sm:w-1/2 px-3 mb-6">
    <div class="relative aspect-ratio-square md:aspect-ratio-rectangle overflow-hidden">
        <div
            class="absolute inset-0 w-full h-full bg-center bg-cover bg-no-repeat tile-bg duration-500 ease-in-out"
            data-initiated="false"
            data-bg="<?php echo get_the_post_thumbnail_url(); ?>"
        ></div>
        <div
            class="absolute inset-0 w-full h-full transition-transform duration-500 ease-in-out tile-movable-inner cursor-pointer"
            @click="$dispatch('portfolio-modal', {
                id: <?php echo get_the_ID(); ?>,
                posttype: '<?php echo get_post_type() ?>'
            })"
        >
            <div class="absolute inset-0 w-full h-full p-8 flex flex-col justify-end">
                <div
                    class="tile-header-bg absolute bottom-0 left-0 right-0"
                    style="height: 25%;"
                ></div>
                <div class="text-white font-bold leading-normal relative"><?php echo get_the_title(); ?></div>
                <div
                    class="tile-action-icon tile-action-icon-video top-0 left-0 mt-6 ml-6 md:mt-0 md:ml-auto absolute md:top-auto right-0 mx-auto md:opacity-0 transition-opacity duration-500 ease-in-out rounded-full md:bottom-1/2 md:transform md:translate-y-1/2 bg-center bg-no-repeat"
                    style="background-color: #721F36;"
                ></div>
            </div>
            <?php if ($portfolio_list): ?>
            <div
                class="absolute inset w-full h-full tile-content"
                style="background: #2F3343;"
            >
                <div class="p-8 overflow-auto tile-content-inner">
                    <?php if (carbon_get_the_post_meta('video_list_heading')): ?>
                    <div class="text-white uppercase font-bold mb-5">
                        <?php echo carbon_get_the_post_meta('video_list_heading'); ?></div>
                    <?php endif;?>
                    <ul class="tile-list text-sm text-white">
                        <?php foreach ($portfolio_list as $list_item): ?>
                        <li class="relative pl-8"><?php echo $list_item['video_list_item']; ?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <?php endif;?>
        </div>
        <div
            class="tile-hider absolute inset-0"
            style="background-color: rgb(247, 247, 247);"
        ></div>
    </div>
</div>