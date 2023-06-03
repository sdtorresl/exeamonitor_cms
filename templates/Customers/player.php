<div id="player">

    <section class="card">
        <div class="row d-flex">
            <figure id="logo-container" class="col s12 m3 l2">
                <?= $this->Html->Image('../' . str_replace('webroot', '', $customer->logo_dir) . DS . $customer->logo); ?>
            </figure>

            <div class="col s12 m6 l8 player-container">
                <aside>
                    <h2 class="title"><?= $customer->stream_name ?></h2>
                    <div class="description">
                        <span id="song-title"><?= __('Loading...') ?></span><span id="artist"></span>
                    </div>
                </aside>
                <div id="player-controls">
                    <a href="javascript:;" id="btn-play" class="play">
                        <i id="play-icon" class="fas fa-play"></i>
                    </a>

                    <span style="width: 10px"></span>

                    <a href="javascript:;" id="btn-pause" class="pause">
                        <i id="pause-icon" class="fas fa-pause"></i>
                    </a>

                    <div id="track-info">
                        <div id="time-container">
                            <div id="elapsed-time">00:00:00</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col s12 m3 l2 d-flex ai-center jc-center">
                <div class="media-wrapper">
                    <div id="download">
                        <?php if ($customer->backup_url) : ?>
                            <?= __('Download') ?>
                            <span>
                                <a target="_blank" href="<?= $customer->backup_url ?>">
                                    <i id="download-icon" class="fas fa-download"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</div>

<style>
    nav {
        position: relative;
    }

    body {
        position: relative;
        min-height: 100vh;
        z-index: -1;
    }

    <?php if ($customer->primary_color) : ?>#btn-play-pause,
    #btn-play,
    #btn-pause,
    progress,
    #volume-bar {
        background: <?= $customer->primary_color ?> !important;
    }

    #volume-down>i,
    #volume-up>i,
    #download-icon {
        color: <?= $customer->primary_color ?> !important;
    }

    <?php endif; ?><?php if ($customer->background) : ?>body {
        background-image: url('<?= '..' . DS . '..' . DS . str_replace('webroot', '', $customer->background_dir) . DS . $customer->background ?>');
        background-size: 100%;
    }

    <?php endif; ?><?php if ($preview == false) : ?>main {
        padding: 12% 10% !important;
    }

    #player section {
        margin: 0 !important;
    }

    <?php endif; ?><?php if ($customer->secondary_color) : ?>body:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* Add transparency when background image is set */
        background: <?= $customer->secondary_color ?><?= $customer->background ? 'DD' : '' ?> !important;
        z-index: 0;
    }

    progress::-moz-progress-bar,
    #volume-value {
        background: <?= $customer->secondary_color ?> !important;
    }

    <?php endif; ?>
</style>


<script type="text/javascript">
    const source = '<?= $customer->stream_url ?>';
    const metadataURI = '<?= $this->Url->build([
                                "prefix" => "Api",
                                "controller" => "Customers",
                                "action" => "metadata",
                                "?" => ["stream" => $customer->stream_url],
                                "_ext" => "json",
                            ]); ?>';
    const posId = "<?= $this->getRequest()->getSession()->read('Auth.point_of_sale_id'); ?>";

    const checksURI = '<?= $this->Url->build([
                            "prefix" => "Api",
                            "controller" => "Checks",
                            "action" => "index",
                            "_ext" => "json"
                        ]); ?>';

    const csrfToken = '<?= $_COOKIE['csrfToken'] ?>';
</script>

<?= $this->Html->script('/node_modules/icecast-metadata-player/build/icecast-metadata-player-1.15.6.main.min.js'); ?>
<?= $this->Html->script('player'); ?>