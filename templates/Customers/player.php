<div id="player">
    <section class="card">
        <div class="row">
            <figure id="logo-container" class="col s12 m3 l2">
                <?= $this->Html->image('customer-logo.png') ?>
            </figure>

            <div class="col s12 m6 l8 player-container">
                <div>
                    <h2 class="title"><?= $customer->name ?></h2>
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
                        <p>
                            <?= __('Download') ?>
                            <span>
                                <i class="fas fa-download"></i>
                            </span>
                        </p>
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

<?= $this->Html->script('player'); ?>