<?php
/**
* Team：数据四骑士,NKU
* Coding by 杨中秀 2312323
* this is heroes list
*/
/*
 * Heroes List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

//本页面专用样式，保证一定生效
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
/* 英雄卡片里的“查看生平”按钮，不要占满整行 */
.card-hero .btn-battle-detail {
    display: inline-block !important;
    width: auto !important;
    max-width: max-content;
    align-self: flex-start;   /* 在 flex 布局里靠左，不拉伸 */
    padding: 0.3rem 1.2rem;   /* 也可以稍微缩小一点 */
}

.btn-battle-detail:hover,
.btn-battle-detail:focus {
    background-color: #712dbfd2;
    border-color: #712dbfd2;
    color: #fff;
    text-decoration: none;
}
.card-hero {
    display: flex;
    gap: 1.5rem;              /* 图片和文字之间的间距 */
    margin-bottom: 1.5rem;
    align-items: stretch;
}

.card-hero .card-img-wrapper {
    flex: 0 0 220px;          /* 图片区域固定宽度，可按需要调 */
    max-width: 220px;
    overflow: hidden;
}

.card-hero .card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;        /* 保持裁剪填充 */
    display: block;
}

.card-hero .card-body {
    flex: 1;                  /* 文本区域占剩余空间 */
    display: flex;
    flex-direction: column;
    justify-content: center;  /* 文本垂直居中，可按需要保留/删除 */
}

/* 小屏幕下改回上下布局，避免太挤 */
@media (max-width: 768px) {
    .card-hero {
        flex-direction: column;
    }
    .card-hero .card-img-wrapper {
        flex: none;
        max-width: 100%;
    }
}

/* 筛选栏整体容器 */
.heroes-toolbar {
    background: #F5F0E6; /* 羊皮纸色 - 统一主题背景 */
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    border: 1px solid #EBE5D5; /* 羊皮纸深色边框 */
}

/* 表单布局 */
.heroes-toolbar__form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* 第一行：搜索框 + 按钮 */
.heroes-toolbar__row {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

/* 搜索框容器 */
.heroes-search {
    position: relative;
    flex: 1;
    min-width: 200px;
    margin-bottom: 0; /* 覆盖默认label样式 */
}

/* 搜索输入框 */
.heroes-search__input {
    width: 100%;
    padding: 0.6rem 1rem 0.6rem 2.5rem; /* 左侧留出图标位置 */
    border: 1px solid #D4C5A5; /* 古铜色边框 */
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    background-color: #fff; /* 保持白色背景以突出输入内容 */
}

.heroes-search__input:focus {
    border-color: #DAA520; /* 胜利金 */
    box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.15);
    outline: none;
}

/* 搜索图标 */
.heroes-search__icon {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: #8B7355; /* 青铜色图标 */
    pointer-events: none;
    font-size: 1rem;
}

/* 按钮通用 */
.heroes-toolbar .btn {
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s;
}

.heroes-toolbar__primary {
    background-color: #DAA520; /* 胜利金 */
    border-color: #DAA520;
    color: #fff;
}

.heroes-toolbar__primary:hover {
    background-color: #B8860B; /* 暗金色 */
    border-color: #B8860B;
}

.heroes-toolbar__reset {
    color: #666;
    border-color: #D4C5A5;
    background-color: transparent;
}

.heroes-toolbar__reset:hover {
    background-color: rgba(0,0,0,0.05);
    color: #333;
}

/* 第二行：下拉框 */
.heroes-toolbar__row--selects {
    justify-content: flex-start;
}

.heroes-select {
    max-width: 200px;
    border-radius: 8px;
    border: 1px solid #D4C5A5;
    padding: 0.5rem 2rem 0.5rem 1rem;
    background-position: right 0.75rem center;
    cursor: pointer;
    background-color: #fff;
}

.heroes-select:focus {
    border-color: #DAA520; /* 胜利金 */
    box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.15);
}

/* 筛选结果统计文字 */
.heroes-toolbar__meta {
    margin-left: auto;
    color: #666;
    font-size: 0.9rem;
    padding-left: 1rem;
}

/* 标签区域 */
.heroes-toolbar__chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

/* 响应式调整 */
@media (max-width: 768px) {
    .heroes-toolbar {
        padding: 1rem;
    }
    
    .heroes-toolbar__row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .heroes-select {
        max-width: 100%;
    }
    
    .heroes-toolbar__meta {
        margin-left: 0;
        text-align: center;
        margin-top: 0.5rem;
    }
}

/* 统一的副标题样式 */
.hero-subtitle {
    font-size: 18px;
    letter-spacing: 3px;
    color: rgba(0,0,0,.60);
    font-weight: 500;
    margin-top: 0.5rem;
}

/* 新增：拉开标题文字和下面装饰的距离 */
.page-header p {
    margin-bottom: 40px;
}

CSS;
$this->registerCss($css);
// >>> 新增结束

$this->title = '英雄谱';
$this->params['bodyClass'] = 'page-heroes';
?>

<div class="page-header">
    <div class="container">
        <h1>英雄谱</h1>
        <p class="hero-subtitle">铭记每一位为国捐躯的抗战英雄，他们的名字如同璀璨星辰，永远照亮中华民族的精神天空。</p>
    </div>
</div>



<div class="filter-bar heroes-toolbar">
  <div class="container">
    <form class="filter-form heroes-toolbar__form" id="hero-filter-form">

      <div class="heroes-toolbar__row">
        <label class="heroes-search">
          <input
            id="hero-search"
            type="text"
            class="form-control heroes-search__input"
            placeholder="搜索英雄姓名或关键词…"
            name="q"
            autocomplete="off"
          >
          <span class="heroes-search__icon" aria-hidden="true">🔍</span>
        </label>

        <button type="submit" class="btn btn-primary heroes-toolbar__primary">筛选</button>
        <button type="button" class="btn btn-outline-secondary heroes-toolbar__reset" id="resetFilter">重置</button>
      </div>

      <div class="heroes-toolbar__row heroes-toolbar__row--selects">
        <select class="form-control heroes-select" name="army" id="hero-army">
          <option value="">所属部队</option>
          <option value="8route">八路军</option>
          <option value="n4a">新四军</option>
          <option value="ne_army">东北抗联</option>
          <option value="kmt">国民革命军</option>
        </select>

        <select class="form-control heroes-select" name="rank" id="hero-rank">
          <option value="">军衔 / 职务</option>
          <option value="general">将官</option>
          <option value="officer">校官</option>
          <option value="soldier">士兵</option>
        </select>

        <div class="heroes-toolbar__meta" id="filterMeta"></div>
      </div>

      <div class="heroes-toolbar__chips" id="filterChips"></div>
    </form>
  </div>
</div>

<div class="heroes-list">
    <div class="container">
        <div class="heroes-grid" id="heroes-grid">
            <!-- 英雄列表 - 动态渲染 -->
            <?php foreach ($heroes as $hero): ?>
            <div class="card card-hero" data-army="<?= htmlspecialchars($hero->army) ?>" data-rank="<?= htmlspecialchars($hero->rank) ?>">
                <div class="card-img-wrapper">
                    <img src="<?= Url::to('@web/assets/images/heroes/' . $hero->photo) ?>" alt="<?= htmlspecialchars($hero->name) ?>" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($hero->name) ?></h3>
                    <p class="card-text"><?= htmlspecialchars($hero->title) ?></p>
                    <a href="<?= Url::to(['/heroes/view', 'id' => $hero->id]) ?>" class="btn-battle-detail">
                        查看生平
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>
(function () {
    const form       = document.getElementById('hero-filter-form');
    const searchInput= document.getElementById('hero-search');
    const armySelect = document.getElementById('hero-army');
    const rankSelect = document.getElementById('hero-rank');
    const resetBtn   = document.getElementById('resetFilter');
    const meta       = document.getElementById('filterMeta');
    const chipsBox   = document.getElementById('filterChips');

    // 所有英雄卡片
    const cards = Array.prototype.slice.call(
        document.querySelectorAll('.card-hero')
    );

    // 实际执行筛选的函数
    function applyFilter() {
        const q     = (searchInput.value || '').trim().toLowerCase();
        const army  = (armySelect.value || '').trim();
        const rank  = (rankSelect.value || '').trim();

        let visibleCount = 0;

        cards.forEach(card => {
            const name   = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
            const text   = card.querySelector('.card-text')?.textContent.toLowerCase() || '';
            const cArmy  = (card.dataset.army || '').trim();
            const cRank  = (card.dataset.rank || '').trim();

            const matchSearch = !q || name.includes(q) || text.includes(q);
            const matchArmy   = !army || cArmy === army;
            const matchRank   = !rank || cRank === rank;

            const match = matchSearch && matchArmy && matchRank;

            card.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        // 显示数量
        if (meta) {
            meta.textContent = visibleCount
                ? `共找到 ${visibleCount} 位英雄`
                : '未找到符合条件的英雄';
        }

        // 显示已选条件的小标签
        if (chipsBox) {
            chipsBox.innerHTML = '';
            const chips = [];

            if (q) {
                chips.push(createChip('关键词', q, () => {
                    searchInput.value = '';
                    applyFilter();
                }));
            }
            if (army) {
                const label = armySelect.options[armySelect.selectedIndex].text;
                chips.push(createChip('所属部队', label, () => {
                    armySelect.value = '';
                    applyFilter();
                }));
            }
            if (rank) {
                const label = rankSelect.options[rankSelect.selectedIndex].text;
                chips.push(createChip('军衔 / 职务', label, () => {
                    rankSelect.value = '';
                    applyFilter();
                }));
            }

            chips.forEach(chip => chipsBox.appendChild(chip));
            chipsBox.style.display = chips.length ? 'block' : 'none';
        }
    }

    // 小标签（chip）生成
    function createChip(type, text, onRemove) {
        const span = document.createElement('span');
        span.className = 'badge bg-light text-dark me-2 mb-1';
        span.style.cursor = 'pointer';
        span.innerHTML = `${type}：${text} &times;`;
        span.addEventListener('click', onRemove);
        return span;
    }

    // 简单防抖，减少输入时的频繁筛选
    function debounce(fn, delay) {
        let timer = null;
        return function () {
            const args = arguments;
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(null, args), delay);
        };
    }

    // 绑定事件
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            applyFilter();
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', debounce(applyFilter, 300));
    }

    if (armySelect) {
        armySelect.addEventListener('change', applyFilter);
    }

    if (rankSelect) {
        rankSelect.addEventListener('change', applyFilter);
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            searchInput.value = '';
            armySelect.value  = '';
            rankSelect.value  = '';
            applyFilter();
        });
    }

    // 初始执行一次，让数量显示正确
    applyFilter();
})();
</script>