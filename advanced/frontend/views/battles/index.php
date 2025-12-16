<?php
/**add by 2312323 杨中秀
 * Battles List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

// <<< 新增：本页面专用样式，保证一定生效
$css = <<<CSS
.view-toggle {
    display: flex;
    gap: .5rem;
    margin-bottom: 1.5rem;
}

.view-toggle .btn-toggle {
    border: 1px solid #f89b06ff;
    background: #f89b06ff;
    padding: .4rem 1rem;
    border-radius: 999px;
    cursor: pointer;
    font-size: 0.95rem;
}

.view-toggle .btn-toggle.active {
    background: #f89b06ff;
    border-color: #f89b06ff;
    color: #fff;
}
/* 查看详情按钮样式 */
.btn-battle-detail {
    display: inline-block;
    padding: 0.35rem 1rem;
    border-radius: 999px;
    border: 1px solid #ea443eff;
    background-color: #ea443eff;
    color: #fff;
    font-size: 0.9rem;
    text-decoration: none;
    line-height: 1.3;
    margin-top: 0.5rem;
}
.btn-battle-detail:hover,
.btn-battle-detail:focus {
    background-color: #712dbfd2;
    border-color: #712dbfd2;
    color: #fff;
    text-decoration: none;
}

.battle-map-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.battle-map-item {
    background: #fff;
    border-radius: 14px;
    padding: 1rem;
    box-shadow: 0 8px 20px rgba(0,0,0,.12);
}

.battle-map-item img {
    width: 100%;
    border-radius: 10px;
    display: block;
}

.map-desc {
    margin-top: 0.75rem;
    font-size: 0.9rem;
    line-height: 1.6;
    color: #555;
}

/* 统一的副标题样式 */
.hero-subtitle {
    font-size: 18px;
    letter-spacing: 3px;
    color: rgba(0,0,0,.60);
    font-weight: 500;
    margin-top: 0.5rem;
}

CSS;
$this->registerCss($css);
// >>> 新增结束

$this->title = '战役史诗';
$this->params['bodyClass'] = 'page-battles';
?>

<div class="page-header">
    <div class="container">
        <h1>战役史诗</h1>
        <p class="hero-subtitle">重温那些惊天地、泣鬼神的伟大战役，见证中华民族不屈的脊梁。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="btn-toggle active" data-view="list">列表视图</button>
            <button class="btn-toggle" data-view="map">地图视图</button>
        </div>

        <!-- List View（默认显示） -->
        <div class="battles-list" id="battles-list-view">
            <?php foreach ($battles as $battle): ?>
            <article class="battle-item fade-in-up">
                <img src="<?= Url::to('@web/assets/images/battles/' . ($battle->image ?: 'default.jpg')) ?>" alt="<?= htmlspecialchars($battle->name) ?>" class="battle-image" loading="lazy">
                <div class="battle-content">
                    <div class="battle-meta">
                        <span class="date"><?= date('Y年m月', strtotime($battle->start_date)) ?></span>
                        <span class="location"><?= htmlspecialchars($battle->location) ?></span>
                    </div>
                    <h3><?= htmlspecialchars($battle->name) ?></h3>
                    <p><?= htmlspecialchars($battle->description) ?></p>
                    <a href="<?= Url::to(['/battles/view', 'id' => $battle->id]) ?>"
                    class="btn-battle-detail">
                        查看详情
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Map View（默认隐藏，点击按钮后显示） -->
        <div class="battles-map-container" id="battles-map-view" style="display: none;">
            <div class="battle-map-list">
                <?php foreach ($battles as $battle): ?>
                    <?php if ($battle->map_image): ?>
                    <div class="battle-map-item">
                        <img
                            src="<?= Url::to('@web/assets/images/battles/' . $battle->map_image) ?>"
                            alt="<?= htmlspecialchars($battle->name) ?>地图"
                            loading="lazy"
                        >
                        <p class="map-desc"><?= htmlspecialchars($battle->name) ?>（<?= date('Y年', strtotime($battle->start_date)) ?>）战役示意图。</p>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
    const buttons  = document.querySelectorAll('.view-toggle .btn-toggle');
    const listView = document.getElementById('battles-list-view');
    const mapView  = document.getElementById('battles-map-view');

    function switchView(view) {
        if (!listView || !mapView) return;

        if (view === 'map') {
            listView.style.display = 'none';
            mapView.style.display  = '';
        } else {
            listView.style.display = '';
            mapView.style.display  = 'none';
        }

        // 切换按钮状态
        buttons.forEach(function (btn) {
            const isActive = btn.getAttribute('data-view') === view;
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    }

    // 默认列表视图
    switchView('list');

    // 绑定按钮点击
    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const view = this.getAttribute('data-view');
            switchView(view);
        });
    });
})();
</script>

