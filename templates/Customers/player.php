<div id="player">
    <section class="card">
        <div class="row">
            <figure id="logo-container" class="col s12 m3 l2">
                <?= $this->Html->image('customer-logo.png') ?>
            </figure>

            <div class="col s12 m6 l8 player-container">
                <div>
                    <h2 class="title"><?= $customer->stream_name ?></h2>
                    <p class="description"><p id="artist"></p></p>
                </div>
                <div id="player-controls">
                    <a href="javascript:;" id="btn-play-pause" class="play">
                        <i id="play-pause-icon"></i>
                    </a>

                    <div id="track-info">
                        <div id="progress-container">
                            <progress id='progress-bar' min='0' max='100' value='0'></progress>
                        </div>
                        <div id="time-container">
                            <div id="elapsed-time">00:00:00</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m3 l2">
                <div class="media-wrapper">
                    <div id="download">
                        <?php if($customer->backup_url): ?>
                        <?= __('Download') ?>
                        <span>
                            <a target="_blank" href="<?= $customer->backup_url ?>">
                                <i id="download-icon" class="fas fa-download"></i>
                            </a>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div id="volume-controls">
                        <a href="javascript:;" id="volume-down">
                            <i class="fas fa-minus"></i>
                        </a>
                        
                        <div id="volume-bar">
                            <span id="volume-value"></span>
                        </div>

                        <a href="javascript:;" id="volume-up">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    nav {
        position: relative;
    }
    
    <?php if($customer->primary_color): ?>
        #btn-play-pause, progress, #volume-bar {
            background: #<?= $customer->primary_color ?>!important;
        }
        #volume-down > i, #volume-up > i, #download-icon {
            color: #<?= $customer->primary_color ?>!important;
        }
    <?php endif; ?>
        
    <?php if($customer->background): ?>
        body {
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/a/a7/Restaurante_El_Corral.jpg');
            background-size: 100%;
            position: relative;
            height: 100vh;
            z-index: -1;
        }
    <?php endif; ?>

    <?php if($customer->secondary_color): ?>
        body:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Add transparency when background image is set */
            background: #<?= $customer->secondary_color ?><?= $customer->background ? 'BB' : '' ?>!important;
            z-index: 0;
        }
        progress::-moz-progress-bar, #volume-value {
            background: #<?= $customer->secondary_color ?>!important;
        }
    <?php endif; ?>
</style>


<script type="text/javascript">
    const source = '<?= $customer->stream_url ?>';
</script>

<?= $this->Html->script('player'); ?>